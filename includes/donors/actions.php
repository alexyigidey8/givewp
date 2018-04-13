<?php
/**
 * Insert donor comment to donation.
 *
 * @since 2.1.0
 *
 * @param int   $donation_id
 * @param array $donation_data
 *
 * @return bool
 */
function __give_insert_donor_donation_comment( $donation_id, $donation_data ) {
	switch ( true ){
		case ! empty( $_POST['give_comment'] ):
			give_insert_donor_donation_comment(
				$donation_id,
				$donation_data['user_info']['id'],
				trim( give_clean( $_POST['give_comment'] ) ),
				array(
					'comment_author_email' => $donation_data['user_info']['email']
				)
			);

		case ! empty( $_POST['give_anonymous_donation'] ):
			give_update_meta( $donation_id, '_give_anonymous_donation', absint( $_POST['give_anonymous_donation'] ) );
	}
}

add_action( 'give_insert_payment', '__give_insert_donor_donation_comment', 10, 2 );


/**
 * Update donor comment status when donation status update
 *
 * @since 2.1.0
 *
 * @param $donation_id
 * @param $status
 */
function __give_update_donor_donation_comment_status( $donation_id, $status ) {
	$approve = absint( 'publish' === $status );

	/* @var WP_Comment $note */
	$donor_comment = give_get_donor_donation_comment( $donation_id, give_get_payment_donor_id( $donation_id ) );

	if( $donor_comment instanceof WP_Comment ) {
		wp_set_comment_status( $donor_comment->comment_ID, (string) $approve );
	}
}

add_action( 'give_update_payment_status', '__give_update_donor_donation_comment_status', 10, 2 );

/**
 * Remove donor comment when donation delete
 *
 * @since 2.1.0
 *
 * @param $donation_id
 */
function __give_remove_donor_donation_comment( $donation_id ) {
	/* @var WP_Comment $note */
	$donor_comment = give_get_donor_donation_comment( $donation_id, give_get_payment_donor_id( $donation_id ) );

	if( $donor_comment instanceof WP_Comment ) {
		wp_delete_comment( $donor_comment->comment_ID );
	}
}

add_action( 'give_payment_deleted', '__give_remove_donor_donation_comment', 10 );