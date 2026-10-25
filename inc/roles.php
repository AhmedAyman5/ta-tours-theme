<?php
/**
 * Offers Manager role, offer capabilities for administrators,
 * and the narrow attachment capability mapping for the client.
 *
 * Roles are stored in the database, so they are created by the Setup Tool.
 * Administrators also receive the offer capabilities automatically once per
 * TA_CAPS_VERSION (see ta_maybe_grant_admin_offer_caps()).
 *
 * @package ta-tours
 */

defined( 'ABSPATH' ) || exit;

// Bump when the offer capabilities change so administrators are updated again.
define( 'TA_CAPS_VERSION', '1' );

/**
 * Role key of the client who only manages offers.
 *
 * @return string
 */
function ta_offers_role() {
	return 'ta_offers_manager';
}

/**
 * Primitive capabilities of the "offer" post type
 * (capability_type offer/offers, map_meta_cap true).
 *
 * @return string[]
 */
function ta_offer_caps() {
	return array(
		'edit_offers',
		'edit_others_offers',
		'edit_published_offers',
		'edit_private_offers',
		'publish_offers',
		'delete_offers',
		'delete_others_offers',
		'delete_published_offers',
		'delete_private_offers',
		'read_private_offers',
	);
}

/**
 * All capabilities of the Offers Manager role.
 *
 * @return string[]
 */
function ta_offers_role_caps() {
	return array_merge( array( 'read', 'upload_files' ), ta_offer_caps() );
}

/**
 * Whether a user has the Offers Manager role.
 *
 * @param WP_User|int|null $user User object or ID; defaults to the current user.
 * @return bool
 */
function ta_is_offers_manager( $user = null ) {
	if ( null === $user ) {
		$user = wp_get_current_user();
	} elseif ( ! $user instanceof WP_User ) {
		$user = get_userdata( (int) $user );
	}

	return $user instanceof WP_User && in_array( ta_offers_role(), (array) $user->roles, true );
}

/**
 * Add the offer capabilities to administrators. Only adds, never removes.
 *
 * @return int Number of capabilities added.
 */
function ta_grant_admin_offer_caps() {
	$role  = get_role( 'administrator' );
	$added = 0;

	if ( ! $role ) {
		return 0;
	}

	foreach ( ta_offer_caps() as $cap ) {
		if ( ! $role->has_cap( $cap ) ) {
			$role->add_cap( $cap );
			++$added;
		}
	}

	return $added;
}

/**
 * Create the Offers Manager role, or add any capability it is missing.
 *
 * @return array{0: string, 1: string} Log row for the Setup Tool.
 */
function ta_setup_offers_role() {
	$name = ta_t( 'admin_role_name', 'ar' ) . ' / ' . ta_t( 'admin_role_name', 'en' );
	$role = get_role( ta_offers_role() );

	if ( ! $role ) {
		add_role( ta_offers_role(), $name, array_fill_keys( ta_offers_role_caps(), true ) );
		/* translators: %s: role name. */
		return array( 'created', sprintf( __( 'Created the "%s" role (offers, media and profile only).', 'ta-tours' ), $name ) );
	}

	$added = 0;
	foreach ( ta_offers_role_caps() as $cap ) {
		if ( ! $role->has_cap( $cap ) ) {
			$role->add_cap( $cap );
			++$added;
		}
	}

	if ( $added ) {
		/* translators: 1: role name, 2: number of capabilities. */
		return array( 'updated', sprintf( __( 'Added %2$d missing capabilities to the "%1$s" role.', 'ta-tours' ), $name, $added ) );
	}

	/* translators: %s: role name. */
	return array( 'exists', sprintf( __( 'The "%s" role already exists with all its capabilities.', 'ta-tours' ), $name ) );
}

/**
 * Setup Tool step: administrator offer capabilities.
 *
 * @return array{0: string, 1: string} Log row.
 */
function ta_setup_admin_offer_caps() {
	$added = ta_grant_admin_offer_caps();
	update_option( 'ta_caps_version', TA_CAPS_VERSION );

	if ( $added ) {
		/* translators: %d: number of capabilities. */
		return array( 'updated', sprintf( __( 'Granted %d offer capabilities to the Administrator role.', 'ta-tours' ), $added ) );
	}

	return array( 'exists', __( 'Administrators already have all offer capabilities.', 'ta-tours' ) );
}

/**
 * Safeguard: grant administrators the offer capabilities once per TA_CAPS_VERSION,
 * so admins keep access to Offers even before the Setup Tool is run.
 *
 * Runs on init in admin requests (before the admin menu is built and before
 * admin_init, so the very first admin page already shows Offers) and on theme switch.
 *
 * @return void
 */
function ta_maybe_grant_admin_offer_caps() {
	if ( get_option( 'ta_caps_version' ) === TA_CAPS_VERSION ) {
		return;
	}

	if ( ta_grant_admin_offer_caps() && is_user_logged_in() ) {
		// Refresh the current user's cached capabilities for this request.
		wp_get_current_user()->get_role_caps();
	}

	update_option( 'ta_caps_version', TA_CAPS_VERSION );
}
add_action( 'after_switch_theme', 'ta_maybe_grant_admin_offer_caps' );

/**
 * Run the safeguard on admin requests only.
 *
 * @return void
 */
function ta_maybe_grant_admin_offer_caps_admin() {
	if ( is_admin() ) {
		ta_maybe_grant_admin_offer_caps();
	}
}
add_action( 'init', 'ta_maybe_grant_admin_offer_caps_admin', 20 );

/**
 * Let an Offers Manager edit (alt text, title) and delete attachments they uploaded.
 *
 * Core maps these checks to edit_posts / delete_posts, which the role must not have
 * (it would unlock Posts, Comments and Tools). Applies only when the object is an
 * attachment, the user has the ta_offers_manager role and upload_files, and is the
 * attachment's author. Nothing changes for any other role or post type.
 *
 * @param string[] $caps    Primitive capabilities required.
 * @param string   $cap     Capability being checked.
 * @param int      $user_id User ID.
 * @param array    $args    Extra arguments (the post ID first).
 * @return string[]
 */
function ta_map_own_attachment_caps( $caps, $cap, $user_id, $args ) {
	if ( ! in_array( $cap, array( 'edit_post', 'delete_post' ), true ) || empty( $args[0] ) ) {
		return $caps;
	}

	$post = get_post( (int) $args[0] );

	if ( ! $post || 'attachment' !== $post->post_type || (int) $post->post_author !== (int) $user_id ) {
		return $caps;
	}

	$user = get_userdata( $user_id );

	if ( ! ta_is_offers_manager( $user ) || ! $user->has_cap( 'upload_files' ) ) {
		return $caps;
	}

	return array( 'upload_files' );
}
add_filter( 'map_meta_cap', 'ta_map_own_attachment_caps', 10, 4 );
