<?php
if(isset($_GET['ays_quiz_tab'])){
    $ays_quiz_tab = esc_attr($_GET['ays_quiz_tab']);
}else{
    $ays_quiz_tab = 'tab1';
}
$action = (isset($_GET['action'])) ? sanitize_key($_GET['action']) : '';
$heading = '';
$loader_iamge = '';

$id = (isset($_GET['quiz'])) ? absint(intval($_GET['quiz'])) : null;

$user_id = get_current_user_id();
$user = get_userdata($user_id);

$author = array(
    'id' => $user->ID,
    'name' => $user->data->display_name
);

$quiz = array(
    'title' => '',
    'author_id' => $user_id,
    'description' => '',
    'quiz_image' => '',
    'quiz_category_id' => '1',
    'question_ids' => '',
    'create_date' => current_time( 'mysql' ),
    'published' => 1,
    'quiz_url'  => '',
);
$options = array(
    'color'                                     => '#5d6cf9',
    'bg_color'                                  => '#fff',
    'text_color'                                => '#000000',
    'height'                                    => 450,
    'width'                                     => 800,
    'timer'                                     => 100,
    'information_form'                          => 'disable',
    'form_name'                                 => '',
    'form_email'                                => '',
    'form_phone'                                => '',
    'enable_logged_users'                       => '',
    'image_width'                               => '',
    'image_height'                              => '',
    'enable_correction'                         => 'on',
    'enable_questions_counter'                  => 'on',
    'limit_users'                               => '',
    'limitation_message'                        => '',
    'redirect_url'                              => '',
    'redirection_delay'                         => '',
    'enable_progress_bar'                       => '',
    'randomize_questions'                       => '',
    'randomize_answers'                         => '',
    'enable_questions_result'                   => '',
    'enable_average_statistical'                => 'on',
    'enable_next_button'                        => 'on',
    'enable_previous_button'                    => 'on',
    'custom_css'                                => '',
    'enable_restriction_pass'                   => '',
    'restriction_pass_message'                  => '',
    'user_role'                                 => '',
    'result_text'                               => '',
    'enable_result'                             => '',
    'enable_timer'                              => 'off',
    'enable_pass_count'                         => 'off',
    'enable_quiz_rate'                          => '',
    'enable_rate_avg'                           => '',
    'enable_rate_comments'                      => '',
    'hide_score'                                => 'off',
    'rate_form_title'                           => '',
    'enable_box_shadow'                         => 'on',
    'box_shadow_color'                          => '#c9c9c9',
    'quiz_border_radius'                        => '8',
    'quiz_bg_image'                             => '',
    'enable_border'                             => '',
    'quiz_border_width'                         => '1',
    'quiz_border_style'                         => 'solid',
    'quiz_border_color'                         => '#000',
    'quiz_timer_in_title'                       => '',
    'enable_restart_button'                     => 'off',
    'quiz_loader'                               => 'default',
    'autofill_user_data'                        => 'off',
    'quest_animation'                           => 'shake',
    'enable_bg_music'                           => 'off',
    'quiz_bg_music'                             => '',
    'answers_font_size'                         => '15',
    'show_create_date'                          => 'off',
    'show_author'                               => 'off',
    'enable_early_finish'                       => 'off',
    'answers_rw_texts'                          => 'on_passing',
    'disable_store_data'                        => 'off',
    'enable_background_gradient'                => 'off',
    'background_gradient_color_1'               => '#000',
    'background_gradient_color_2'               => '#fff',
    'quiz_gradient_direction'                   => 'vertical',
    'redirect_after_submit'                     => 'off',
    'submit_redirect_url'                       => '',
    'submit_redirect_delay'                     => '',
    'progress_bar_style'                        => 'third',
    'enable_exit_button'                        => 'off',
    'exit_redirect_url'                         => '',
    'image_sizing'                              => 'cover',
    'quiz_bg_image_position'                    => 'center center',
    'custom_class'                              => '',
    'enable_social_buttons'                     => 'off',
    'enable_social_links'                       => 'off',
    'social_links' => array(
        'linkedin_link'     => '',
        'facebook_link'     => '',
        'twitter_link'      => '',
        'vkontakte_link'    => '',
        'instagram_link'    => '',
        'youtube_link'      => '',
        'behance_link'      => '',
    ),
    'show_quiz_title'                           => 'on',
    'show_quiz_desc'                            => 'on',
    'show_login_form'                           => 'off',
    'mobile_max_width'                          => '',
    'limit_users_by'                            => 'ip',
	'explanation_time'                          => '4',
	'enable_clear_answer'                       => 'off',
	'show_category'                             => 'off',
	'show_question_category'                    => 'off',
    'display_score'                             => 'by_percentage',
    'enable_rw_asnwers_sounds'                  => 'off',
    'enable_enter_key'                          => 'on',
    'show_rate_after_rate'                      => 'on',
    'buttons_text_color'                        => '#ffffff',
    'enable_audio_autoplay'                     => 'off',
    'enable_leave_page'                         => 'on',
    'show_only_wrong_answer'                    => 'off',
    'quiz_max_pass_count'                       => 1,
    'questions_hint_icon_or_text'               => 'default',
    'questions_hint_value'                      => '',
    'progress_live_bar_style'                   => 'default',
    'show_questions_explanation'                => 'on_results_page',
    'enable_questions_ordering_by_cat'          => 'off',
    'enable_send_mail_to_user_by_pass_score'    => 'off',
    'enable_send_mail_to_admin_by_pass_score'   => 'off',
    'show_questions_numbering'                  => 'none',
    'show_answers_numbering'                    => 'none',
    'quiz_loader_custom_gif'                    => '',
    'disable_hover_effect'                      => 'off',
    'quiz_loader_custom_gif_width'              => 100,
    'quiz_title_transformation'                 => 'uppercase',
    'quiz_box_shadow_x_offset'                  => 0,
    'quiz_box_shadow_y_offset'                  => 0,
    'quiz_box_shadow_z_offset'                  => 15,
    'quiz_question_text_alignment'              => 'center',
    'quiz_arrow_type'                           => 'default',
    'quiz_show_wrong_answers_first'             => 'off',
    'quiz_display_all_questions'                => 'off',
    'quiz_timer_red_warning'                    => 'off',
    'quiz_schedule_timezone'                    => get_option( 'timezone_string' ),
    'questions_hint_button_value'               => '',
    'quiz_tackers_message'                      => __( "This quiz is expired!", $this->plugin_name ),
    'quiz_enable_linkedin_share_button'         => 'on',
    'quiz_enable_facebook_share_button'         => 'on',
    'quiz_enable_twitter_share_button'          => 'on',
    'quiz_enable_vkontakte_share_button'        => 'on',
    'quiz_make_responses_anonymous'             => 'off',
    'quiz_make_all_review_link'                 => 'off',
    'quiz_message_before_timer'                 => '',
    'quiz_password_message'                     => '',
    'enable_see_result_confirm_box'             => 'off',
    'display_fields_labels'                     => 'off',
    'social_buttons_heading'                    => '',
    'social_links_heading'                      => '',
    'quiz_enable_question_category_description' => 'off',
    'answers_margin'                            => '12',
    'quiz_message_before_redirect_timer'        => '',
    'buttons_mobile_font_size'                  => 18,
    'quiz_answer_box_shadow_x_offset'           => 0,
    'quiz_answer_box_shadow_y_offset'           => 0,
    'quiz_answer_box_shadow_z_offset'           => 10,
    'quiz_create_author'                        => $user_id,
    'quiz_enable_title_text_shadow'             => "off",
    'quiz_title_text_shadow_color'              => "#333",
    'right_answers_font_size'                   => "16",
    'wrong_answers_font_size'                   => "16",
    'quest_explanation_font_size'               => "16",
    'quiz_waiting_time'                         => "off",
    'quiz_title_text_shadow_x_offset'           => 2,
    'quiz_title_text_shadow_y_offset'           => 2,
    'quiz_title_text_shadow_z_offset'           => 2,
    'quiz_show_only_wrong_answers'              => "off",
    'quiz_title_font_size'                      => 28,
    'quiz_title_mobile_font_size'               => 20,
    'quiz_password_width'                       => "",
    'quiz_review_placeholder_text'              => "",
    'quiz_make_review_required'                 => "off",
    'quiz_enable_results_toggle'                => "off",
    'quiz_review_thank_you_message'             => "",
    'quiz_review_enable_comment_field'          => "on",
    'quest_explanation_mobile_font_size'        => "16",
    'wrong_answers_mobile_font_size'            => "16",
    'quiz_enable_question_image_zoom'           => 'off',
    'right_answers_mobile_font_size'            => '16',
    'quiz_display_messages_before_buttons'      => 'off',
    'enable_question_reporting'                 => 'off',
    'quiz_enable_question_reporting_mail'       => 'off',
    'quiz_enable_user_cհoosing_anonymous_assessment' => 'off',
    'note_text_font_size'                       => "14",
    'note_text_mobile_font_size'                => "14",
    'quiz_questions_numbering_by_category'      => "off",
    'quiz_enable_custom_texts_for_buttons'      => "off",
    'quiz_custom_texts_start_button'            => "Start",
    'quiz_custom_texts_next_button'             => "Next",
    'quiz_custom_texts_prev_button'             => "Prev",
    'quiz_custom_texts_clear_button'            => "Clear",
    'quiz_custom_texts_finish_button'           => "Finish",
    'quiz_custom_texts_see_results_button'      => "See Result",
    'quiz_custom_texts_restart_quiz_button'     => "Restart quiz",
    'quiz_custom_texts_send_feedback_button'    => "Send feedback",
    'quiz_custom_texts_load_more_button'        => "Load more",
    'quiz_custom_texts_exit_button'             => "Exit",
    'quiz_custom_texts_check_button'            => "Check",
    'quiz_custom_texts_login_button'            => "Log In",
    'quiz_enable_quiz_category_description'     => "off",
    'quiz_admin_note_text_transform'            => "none",
    'quiz_quest_explanation_text_transform'     => "none",
    'quiz_right_answer_text_transform'          => "none",
    'quiz_wrong_answer_text_transform'          => "none",
    'quiz_admin_note_text_decoration'           => "none",
    'quiz_quest_explanation_text_decoration'    => "none",
    'quiz_right_answers_text_decoration'        => "none",
    'quiz_wrong_answers_text_decoration'        => "none",
    'quiz_admin_note_letter_spacing'            => 0,
    'quiz_bg_img_during_the_quiz'               => "off",
    'quiz_quest_explanation_letter_spacing'     => 0,
    'quiz_right_answers_letter_spacing'         => 0,
    'quiz_wrong_answers_letter_spacing'         => 0,
    'quiz_admin_note_font_weight'               => "normal",
    'quiz_quest_explanation_font_weight'        => "normal",
    'quiz_right_answers_font_weight'            => "normal",
    'quiz_wrong_answers_font_weight'            => "normal",
    'quiz_section_collapse_flag'                => "off",
    'quiz_content_max_width'                    => 90,
    'quiz_content_mobile_max_width'             => 90,
    'quiz_show_restart_button_on_quiz_fail'     => 'off',
    'question_image_height_mobile'              => '',
    'quiz_timer_warning_text_color'             => "#ff0000",
    'quiz_enable_default_hide_results_toggle'   => "off",
    'quiz_show_restart_button_on_quiz_fail'     => "off",
    'quiz_disable_question_numbering_for_custom_type' => "off",


    //Buttons Styles
    'buttons_size'                              => 'large',
    'buttons_font_size'                         => '18',
    'buttons_left_right_padding'                => '36',
    'buttons_top_bottom_padding'                => '14',
    'buttons_border_radius'                     => '8',
    'buttons_width'                             => '',

    //Answers styles
    'answers_padding'                           => '5',
    'answers_border'                            => 'on',
    'answers_border_width'                      => '1',
    'answers_border_style'                      => 'solid',
    'answers_border_color'                      => '#dddddd',
    'ans_img_height'                            => '150',
    'ans_img_caption_style'                     => 'outside',
    'ans_img_caption_position'                  => 'bottom',
    'answers_box_shadow'                        => 'off',
    'answers_box_shadow_color'                  => '#000',
    'show_answers_caption'                      => 'on',
    'answers_margin'                            => '12',
    'ans_right_wrong_icon'                      => 'none',
    'quiz_bg_img_in_finish_page'                => 'off',
    'finish_after_wrong_answer'                 => 'off',
    'answers_object_fit'                        => 'cover',

    // Develpoer version options
    'enable_copy_protection'                    => '',
	'activeInterval'                            => '',
	'deactiveInterval'                          => '',
	'active_date_check'                         => 'off',
	'active_date_message'                       => __("The quiz has expired!", $this->plugin_name),
    'active_date_pre_start_message'             => __("The quiz will be available soon!", $this->plugin_name),
    'checkbox_score_by'                         => 'on',
    'calculate_score'                           => 'by_correctness',
    'question_bank_type'                        => 'general',
    'enable_tackers_count'                      => 'off',
    'tackers_count'                             => '',
    'show_interval_message'                     => 'on',
    'allow_collecting_logged_in_users_data'     => 'off',
    'quiz_pass_score'                           => 0,
    'make_questions_required'                   => 'off',
    'enable_password'                           => 'off',
    'password_quiz'                             => '',
    'generate_password'                         => 'general',
    'display_score_by'                          => 'by_percentage',
    'show_schedule_timer'                       => 'off',
    'show_timer_type'                           => 'countdown',
    'enable_negative_mark'                      => 'off',
    'negative_mark_point'                       => 0,
    'enable_full_screen_mode'                   => 'off',
    'enable_navigation_bar'                     => 'off',
    'turn_on_extra_security_check'              => 'on',
    'hide_limit_attempts_notice'                => 'off',
    'quiz_enable_coupon'                        => 'off',
    'apply_points_to_keywords'                  => 'off',
    'quiz_enable_password_visibility'           => 'off',
    'question_mobile_font_size'                 => 16,
    'answers_mobile_font_size'                  => 15,
    'limit_attempts_count_by_user_role'         => '',
    'enable_autostart'                          => 'off',
    'quiz_enable_keyboard_navigation'           => 'off',
    'question_count_per_page_type'              => 'general',
    'quiz_timer_type'                           => 'quiz_timer',
    'quiz_pass_score_type'                      => 'percentage',
    'quiz_equal_keywords_text'                  => '',
    'enable_navigation_bar_marked_questions'    => 'off',
    'quiz_question_text_to_speech'              => 'off',
    'quiz_question_text_to_speech_voice'        => 'Microsoft David - English (United States)',
    'quiz_password_import_type'                 => 'default',
    'quiz_navigation_bar_type'                  => 'default',
    'quiz_show_question_tags'                   => 'off',
    'quiz_show_results_based_pass_score'        => 'off',
    'quiz_hide_banner_questions_on_result_page' => 'off',
    'quiz_grid_view_count'                      => '2',
    'quiz_grid_view_count_mobile'               => '2',
    'quiz_send_results_user_without_img'        => 'off',
    'quiz_right_answer_message_user_mail'       => 'off',
    'quiz_wrong_answer_message_user_mail'       => 'off',
    'enable_result_page_pdf_download'           => 'off',
    'quiz_grid_image_view_mobile'               => 'off',
    'points_display'                            => 'hide',


    // Integration option
    'enable_paypal'                             => '',
    'paypal_amount'                             => '',
    'paypal_currency'                           => '',
    'paypal_message'                            => __('You need to pay to pass this quiz.', $this->plugin_name),
    'enable_mailchimp'                          => '',
    'mailchimp_list'                            => '',
	'enable_monitor'                            => '',
	'monitor_list'                              => '',
	'enable_slack'                              => '',
	'slack_conversation'                        => '',
	'active_camp_list'                          => '',
	'active_camp_automation'                    => '',
	'enable_active_camp'                        => '',
    'enable_google_sheets'                      => '',
	'spreadsheet_id'                            => '',
    'payment_type'                              => 'prepay',

    // Email config options
    'send_results_user'                         => 'off', //AV
    'send_interval_msg'                         => 'off',
    'send_results_admin'                        => 'on',
    'send_interval_msg_to_admin'                => 'off',
    'send_certificate_to_admin'                 => 'off',
    'use_subject_for_admin_email'               => 'off',
    'additional_emails'                         => '',
    'email_config_from_email'                   => '',
    'email_config_from_name'                    => '',
    'email_config_from_subject'                 => '',
    'email_config_replyto_email'                => '',
    'email_config_replyto_name'                 => '',
    'send_mail_to_site_admin'                   => 'on',

    'quiz_attributes'                           => array(),
    "certificate_title"                         => '<span style="font-size:50px; font-weight:bold">Certificate of Completion</span>',
    "certificate_body"                          => '<span style="font-size:25px"><i>This is to certify that</i></span><br><br>
            <span style="font-size:30px"><b>%%user_name%%</b></span><br/><br/>
            <span style="font-size:25px"><i>has completed the quiz</i></span><br/><br/>
            <span style="font-size:30px">"%%quiz_name%%"</span> <br/><br/>
            <span style="font-size:20px">with a score of <b>%%score%%</b></span><br/><br/>
            <span style="font-size:25px"><i>dated</i></span><br>
            <span style="font-size:30px">%%current_date%%</span><br/><br/><br/>',
    "certificate_image"                         => '',
    "certificate_frame"                         => 'default',
    "certificate_orientation"                   => 'l',

);
$question_ids = '';
$question_id_array = array();
$question_id_array_count = 0;
$quiz_intervals_defaults = array(
    array(
        'interval_min' => '0',
        'interval_max' => '25',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'A',
        'interval_redirect_url' => '',
        'interval_redirect_delay' => '',
        'interval_mailchimp_tags' => '',
        'interval_file' => '',
        'interval_file_id' => '',
        'interval_file_name' => '',
    ),
    array(
        'interval_min' => '26',
        'interval_max' => '50',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'B',
        'interval_redirect_url' => '',
        'interval_redirect_delay' => '',
        'interval_mailchimp_tags' => '',
        'interval_file' => '',
        'interval_file_id' => '',
        'interval_file_name' => '',
    ),
    array(
        'interval_min' => '51',
        'interval_max' => '75',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'C',
        'interval_redirect_url' => '',
        'interval_redirect_delay' => '',
        'interval_mailchimp_tags' => '',
        'interval_file' => '',
        'interval_file_id' => '',
        'interval_file_name' => '',
    ),
    array(
        'interval_min' => '76',
        'interval_max' => '100',
        'interval_text' => '',
        'interval_image' => '',
        'interval_keyword' => 'D',
        'interval_redirect_url' => '',
        'interval_redirect_delay' => '',
        'interval_mailchimp_tags' => '',
        'interval_file' => '',
        'interval_file_id' => '',
        'interval_file_name' => '',
    ),
);

$quiz_top_keywords_defaults = array(
    array(
        'assign_top_keyword' => 'A',
        'assign_top_keyword_text' => '',
    ),
    array(
        'assign_top_keyword' => 'B',
        'assign_top_keyword_text' => '',
    ),
    array(
        'assign_top_keyword' => 'C',
        'assign_top_keyword_text' => '',
    ),
    array(
        'assign_top_keyword' => 'D',
        'assign_top_keyword_text' => '',
    ),
);

$quiz_intervals_numbers = 4;
$quiz_settings = $this->settings_obj;

$post_id = null;
$ays_quiz_view_post_url = "";
$ays_quiz_edit_post_url = "";
switch ($action) {
    case 'add':
        $heading = __('Add new quiz', $this->plugin_name);
        $quiz_intervals = $quiz_intervals_defaults;
        $quiz_top_keywords = $quiz_top_keywords_defaults;
        $quiz_default_options = ($quiz_settings->ays_get_setting('quiz_default_options') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('quiz_default_options');
        if (! empty($quiz_default_options)) {
            $quiz_default_options = json_decode($quiz_default_options, true);
        }
        if (! empty($quiz_default_options)) {
            $options = $quiz_default_options;
        }
        if( ! isset( $options['certificate_title'] ) || $options['certificate_title'] == '' ){
            $options['certificate_title'] = '<span style="font-size:50px; font-weight:bold">Certificate of Completion</span>';
        }
        if( ! isset( $options['certificate_body'] ) || $options['certificate_body'] == '' ){
            $options['certificate_body'] = '<span style="font-size:25px"><i>This is to certify that</i></span><br><br>
                <span style="font-size:30px"><b>%%user_name%%</b></span><br/><br/>
                <span style="font-size:25px"><i>has completed the quiz</i></span><br/><br/>
                <span style="font-size:30px">"%%quiz_name%%"</span> <br/><br/>
                <span style="font-size:20px">with a score of <b>%%score%%</b></span><br/><br/>
                <span style="font-size:25px"><i>dated</i></span><br>
                <span style="font-size:30px">%%current_date%%</span><br/><br/><br/>';
        }
        break;
    case 'edit':
        $heading = __('Edit quiz', $this->plugin_name);
        $quiz = $this->quizes_obj->get_quiz_by_id($id);
        if (isset( $quiz['options'] ) && $quiz['options'] != "") {
            $options = json_decode($quiz['options'], true);
        }
        $question_ids = (isset( $quiz['question_ids'] ) && $quiz['question_ids'] != "") ? $quiz['question_ids'] : "";
        $question_id_array = explode(',', $question_ids);
        $question_id_array = ($question_id_array[0] == '' && count($question_id_array) == 1) ? array() : $question_id_array;

        $question_id_array_count_data = Quiz_Maker_Data::get_published_questions_count($question_ids);
        if ( !is_null( $question_id_array_count_data ) && !empty($question_id_array_count_data) ) {
            $question_id_array_count = (isset( $question_id_array_count_data['res_count'] ) && absint( $question_id_array_count_data['res_count'] ) > 0) ? absint( $question_id_array_count_data['res_count'] ) : count($question_id_array);
        }

        if (isset( $quiz['intervals'] ) && $quiz['intervals'] != "") {
            $quiz_intervals = json_decode($quiz['intervals'], true);
        } else {
            $quiz_intervals = $quiz_intervals_defaults;
        }
        $quiz_top_keywords = isset($options['assign_keywords']) && !empty($options['assign_keywords']) ? $options['assign_keywords'] : $quiz_top_keywords_defaults;
        $post_id = (isset( $quiz['post_id'] ) && $quiz['post_id'] != "") ? $quiz['post_id'] : null;
        if (!is_null( $post_id )) {
            $ays_quiz_view_post_url = get_permalink($post_id);
            $ays_quiz_edit_post_url = get_edit_post_link($post_id);

            if( !$ays_quiz_view_post_url ){
                $post_id = null;
            }
        }

        break;
}

$author_id =  (isset( $quiz['author_id'] ) && $quiz['author_id'] != "" && $quiz['author_id'] != 0) ? intval( $quiz['author_id'] ) : $user_id;
$owner = false;
if( $user_id == $author_id ){
    $owner = true;
}

if( $this->current_user_can_edit ){
    $owner = true;
}

if( !$owner ){
    $url = esc_url_raw( remove_query_arg( array('action', 'quiz') ) );
    wp_redirect( $url );
}

$disabled_option = '';
$readonly_option = '';
if( !$owner ){
    $disabled_option = ' disabled ';
    $readonly_option = ' readonly ';
}

$quiz_iframe_html = "";
$ays_quiz_get_iframe = "";
if( !is_null( $id ) && intval($id) > 0 ){
    $iframe_attr = array(
        'id'    => $id,
        'embed' => true,
    );

    $ays_quiz_get_iframe = Quiz_Maker_iFrame::get_iframe( $id, $iframe_attr );
    $ays_quiz_get_iframe = str_replace(array("\r\n", "\n", "\r"), "", $ays_quiz_get_iframe);
    $ays_quiz_get_iframe = preg_replace('/\s+/', ' ', $ays_quiz_get_iframe);
        
    $quiz_iframe_html = "<textarea class='ays-quiz-embed-code-textarea display_none_imp' style='display:none;'>". $ays_quiz_get_iframe ."</textarea>";
}


$quiz_title = (isset( $quiz['title'] ) && $quiz['title'] != "") ? stripslashes( esc_attr($quiz['title']) ) : ""; 
$quiz_description = (isset( $quiz['description'] ) && $quiz['description'] != "") ? stripslashes(wpautop($quiz['description'])) : "";
$quiz_published = (isset( $quiz['published'] ) && $quiz['published'] != "") ? esc_attr( absint( $quiz['published'] ) ) : 1;
$quiz_category_id = (isset( $quiz['quiz_category_id'] ) && $quiz['quiz_category_id'] != "") ? absint($quiz['quiz_category_id']) : 1;

if( $action == 'edit' ) {
    $loader_iamge = '<span class="ays_quiz_loader_box" style="padding-left: 8px; display: inline-block;"><img src="' . AYS_QUIZ_ADMIN_URL . '/images/loaders/loading.gif"></span>';
}else{
    $loader_iamge = '<span class="display_none ays_quiz_loader_box"><img src="' . AYS_QUIZ_ADMIN_URL . '/images/loaders/loading.gif"></span>';
}

$quiz_description_live_preivew_nonce = wp_create_nonce( 'quiz-maker-description-live-preivew-nonce' );
$quiz_send_testing_mail_nonce = wp_create_nonce( 'quiz-maker-send-testing-mail-nonce' );

$quiz_intervals = ($quiz_intervals == null) ? $quiz_intervals_defaults : $quiz_intervals;
$quiz_top_keywords = ($quiz_top_keywords == null) ? $quiz_top_keywords_defaults : $quiz_top_keywords;
// $questions = $this->quizes_obj->get_published_questions();
$total_questions_count = $this->quizes_obj->published_questions_record_count();
$quiz_categories = $this->quizes_obj->get_quiz_categories();
$question_categories = $this->get_questions_categories();
$question_categories_array = array();
foreach($question_categories as $cat){
    $question_categories_array[$cat['id']] = $cat['title'];
}

$question_tags = $this->get_questions_tags();
$question_tags_array = array();
foreach($question_tags as $tag){
    $question_tags_array[$tag['id']] = $tag['title'];
}

$options['question_ids'] = $question_ids;
$used_questions = $this->get_published_questions_used();
$question_bank_categories = $this->quizes_obj->get_question_bank_categories($question_ids);

$settings_options = $this->settings_obj->ays_get_setting('options');
if($settings_options){
    $settings_options = json_decode(stripcslashes($settings_options), true);
}else{
    $settings_options = array();
}

$isRazorpayAddonPluginActive = false;
if (is_multisite()) {
    $isRazorpayAddonPluginActive = is_plugin_active('quiz-maker-razorpay/quiz-maker-razorpay.php');
} else {
    $isRazorpayAddonPluginActive = in_array('quiz-maker-razorpay/quiz-maker-razorpay.php', apply_filters('active_plugins', get_option('active_plugins')));
}

// Buttons Text
$buttons_texts_res      = ($this->settings_obj->ays_get_setting('buttons_texts') === false) ? json_encode(array()) : $this->settings_obj->ays_get_setting('buttons_texts');
$buttons_texts          = json_decode( stripcslashes( $buttons_texts_res ) , true);

$start_button           = (isset($buttons_texts['start_button']) && $buttons_texts['start_button'] != '') ? stripslashes( esc_attr( $buttons_texts['start_button'] ) ) : 'Start';
$next_button            = (isset($buttons_texts['next_button']) && $buttons_texts['next_button'] != '') ? stripslashes( esc_attr( $buttons_texts['next_button'] ) ) : 'Next';
$previous_button        = (isset($buttons_texts['previous_button']) && $buttons_texts['previous_button'] != '') ? stripslashes( esc_attr( $buttons_texts['previous_button'] ) ) : 'Prev' ;
$clear_button           = (isset($buttons_texts['clear_button']) && $buttons_texts['clear_button'] != '') ? stripslashes( esc_attr( $buttons_texts['clear_button'] ) ) : 'Clear' ;
$finish_button          = (isset($buttons_texts['finish_button']) && $buttons_texts['finish_button'] != '') ? stripslashes( esc_attr( $buttons_texts['finish_button'] ) ) : 'Finish' ;
$see_result_button      = (isset($buttons_texts['see_result_button']) && $buttons_texts['see_result_button'] != '') ? stripslashes( esc_attr( $buttons_texts['see_result_button'] ) ) : 'See Result' ;
$restart_quiz_button    = (isset($buttons_texts['restart_quiz_button']) && $buttons_texts['restart_quiz_button'] != '') ? stripslashes( esc_attr( $buttons_texts['restart_quiz_button'] ) ) : 'Restart quiz' ;
$send_feedback_button   = (isset($buttons_texts['send_feedback_button']) && $buttons_texts['send_feedback_button'] != '') ? esc_attr(stripslashes($buttons_texts['send_feedback_button'])) : 'Send feedback' ;
$load_more_button       = (isset($buttons_texts['load_more_button']) && $buttons_texts['load_more_button'] != '') ? esc_attr(stripslashes($buttons_texts['load_more_button'])) : 'Load more' ;
$gen_exit_button        = (isset($buttons_texts['exit_button']) && $buttons_texts['exit_button'] != '') ? esc_attr(stripslashes($buttons_texts['exit_button'])) : 'Exit' ;
$gen_check_button       = (isset($buttons_texts['check_button']) && $buttons_texts['check_button'] != '') ? esc_attr(stripslashes($buttons_texts['check_button'])) : 'Check' ;
$gen_login_button       = (isset($buttons_texts['login_button']) && $buttons_texts['login_button'] != '') ? esc_attr(stripslashes($buttons_texts['login_button'])) : 'Log In' ;

$right_answer_sound = (isset($settings_options['right_answer_sound']) && $settings_options['right_answer_sound'] != '') ? true : false;
$wrong_answer_sound = (isset($settings_options['wrong_answer_sound']) && $settings_options['wrong_answer_sound'] != '') ? true : false;
$rw_answers_sounds_status = false;
if($right_answer_sound && $wrong_answer_sound){
    $rw_answers_sounds_status = true;
}

// WP Editor height
$quiz_wp_editor_height = (isset($settings_options['quiz_wp_editor_height']) && $settings_options['quiz_wp_editor_height'] != '') ? absint( sanitize_text_field($settings_options['quiz_wp_editor_height']) ) : 100;

// Question title view
$quiz_question_title_view = (isset($settings_options['quiz_question_title_view']) && sanitize_text_field( $settings_options['quiz_question_title_view'] ) != "") ? stripslashes( esc_attr($settings_options['quiz_question_title_view']) ) : 'question_title';

$quiz_integrations = (get_option( 'ays_quiz_integrations' ) != null) ? json_decode( get_option( 'ays_quiz_integrations' ), true ) : array();
$quiz_paypal = array(
    'state' => (isset($quiz_integrations['paypal_client_id']) && $quiz_integrations['paypal_client_id'] != '') ? true : false,
    'clientId' => isset($quiz_integrations['paypal_client_id']) ? $quiz_integrations['paypal_client_id'] : null,
);

$stripe_res         = ($quiz_settings->ays_get_setting('stripe') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('stripe');
$stripe             = json_decode($stripe_res, true);
$stripe_secret_key  = isset($stripe['secret_key']) && $stripe['secret_key'] != '' ? $stripe['secret_key'] : '';
$stripe_api_key     = isset($stripe['api_key']) && $stripe['api_key'] != '' ? $stripe['api_key'] : '';
$is_enabled_stripe  = $stripe_api_key != '' && $stripe_secret_key != '' ? true : false;

$mailchimp_res = ($quiz_settings->ays_get_setting('mailchimp') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('mailchimp');
$mailchimp = json_decode($mailchimp_res, true);
$mailchimp_username = isset($mailchimp['username']) ? $mailchimp['username'] : '' ;
$mailchimp_api_key = isset($mailchimp['apiKey']) ? $mailchimp['apiKey'] : '' ;
$mailchimp_lists = $this->ays_get_mailchimp_lists($mailchimp_username, $mailchimp_api_key);

$mailchimp_select = array();
if(isset($mailchimp_lists['total_items']) && $mailchimp_lists['total_items'] > 0){
    if (isset($mailchimp_lists['lists'])) {
        foreach($mailchimp_lists['lists'] as $list){
            $mailchimp_select[] = array(
                'listId' => $list['id'],
                'listName' => $list['name']
            );
        }
    }
}else{
    $mailchimp_select = __( "There are no lists", $this->plugin_name );
}

$monitor_res     = ($quiz_settings->ays_get_setting('monitor') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('monitor');
$monitor         = json_decode($monitor_res, true);
$monitor_client  = isset($monitor['client']) ? $monitor['client'] : '';
$monitor_api_key = isset($monitor['apiKey']) ? $monitor['apiKey'] : '';
$monitor_lists   = $this->ays_get_monitor_lists($monitor_client, $monitor_api_key);
$monitor_select  = !isset($monitor_lists['Code']) ? $monitor_lists : __("There are no lists", $this->plugin_name);


$slack_res           = ($quiz_settings->ays_get_setting('slack') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('slack');
$slack               = json_decode($slack_res, true);
$slack_client        = isset($slack['client']) ? $slack['client'] : '';
$slack_secret        = isset($slack['secret']) ? $slack['secret'] : '';
$slack_token         = isset($slack['token']) ? $slack['token'] : '';
$slack_conversations = $this->ays_get_slack_conversations($slack_token);
$slack_select        = !isset($slack_conversations['Code']) ? $slack_conversations : __("There are no conversations", $this->plugin_name);

$active_camp_res               = ($quiz_settings->ays_get_setting('active_camp') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('active_camp');
$active_camp                   = json_decode($active_camp_res, true);
$active_camp_url               = isset($active_camp['url']) ? $active_camp['url'] : '';
$active_camp_api_key           = isset($active_camp['apiKey']) ? $active_camp['apiKey'] : '';
$active_camp_lists             = $this->ays_get_active_camp_data('lists', $active_camp_url, $active_camp_api_key);
$active_camp_automations       = $this->ays_get_active_camp_data('automations', $active_camp_url, $active_camp_api_key);
$active_camp_list_select       = ( !isset($active_camp_lists['Code']) && isset( $active_camp_lists['lists'] ) ) ? $active_camp_lists['lists'] : __("There are no lists", $this->plugin_name);
$active_camp_automation_select = ( !isset($active_camp_automations['Code']) && isset( $active_camp_automations['automations'] ) ) ? $active_camp_automations['automations'] : __("There are no automations", $this->plugin_name);

$zapier_res  = ($quiz_settings->ays_get_setting('zapier') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('zapier');
$zapier      = json_decode($zapier_res, true);
$zapier_hook = isset($zapier['hook']) ? $zapier['hook'] : '';

// Google Sheets
$google_res           = ($quiz_settings->ays_get_setting('google') === false) ? json_encode(array()) : $quiz_settings->ays_get_setting('google');
$google               = json_decode($google_res, true);
$google_client        = isset($google['client']) ? $google['client'] : '';
$google_secret        = isset($google['secret']) ? $google['secret'] : '';
$google_token         = isset($google['token']) ? $google['token'] : '';
$google_refresh_token = isset($google['refresh_token']) ? $google['refresh_token'] : '';

if (isset($_POST['ays_submit']) || isset($_POST['ays_submit_top'])) {
    $_POST['id'] = $id;
    $this->quizes_obj->add_or_edit_quizes($_POST);
}
if (isset($_POST['ays_apply_top']) || isset($_POST['ays_apply'])) {
    $_POST["id"] = $id;
    $_POST['ays_change_type'] = 'apply';
    $this->quizes_obj->add_or_edit_quizes($_POST);
}

if (isset($_POST['ays_default']) || isset($_POST['ays_default_style']) || isset($_POST['ays_default_settings'])
    || isset($_POST['ays_default_results_settings']) || isset($_POST['ays_default_results_limitation'])
    || isset($_POST['ays_default_user_data']) || isset($_POST['ays_default_email'])
) {
    $_POST["id"] = $id;
    $_POST['ays_change_type'] = 'apply';
    $_POST['ays_default_option'] = 'ays_default_option';
    $this->quizes_obj->add_or_edit_quizes($_POST);
}

if (isset($_POST['ays_quiz_cancel_top']) || isset($_POST['ays_quiz_cancel'])) {
    unset($_GET['page']);
    $url = remove_query_arg( array_keys($_GET) );
    wp_redirect( $url );
}

$next_quiz_id = "";
$prev_quiz_id = "";
if ( isset( $id ) && !is_null( $id ) ) {
    $next_quiz = $this->get_next_or_prev_row_by_id( $id, "next", "aysquiz_quizes" );
    $next_quiz_id = (isset( $next_quiz['id'] ) && $next_quiz['id'] != "") ? absint( $next_quiz['id'] ) : null;

    $prev_quiz = $this->get_next_or_prev_row_by_id( $id, "prev", "aysquiz_quizes" );
    $prev_quiz_id = (isset( $prev_quiz['id'] ) && $prev_quiz['id'] != "") ? absint( $prev_quiz['id'] ) : null;
}

$ays_user = wp_get_current_user();
$ays_super_admin_email = get_option('admin_email'); //$user->data->user_email;
$wp_general_settings_url = admin_url( 'options-general.php' );

$quiz_message_vars = array(
    "%%user_name%%"                         => __("User Name", $this->plugin_name),
    "%%user_email%%"                        => __("User Email", $this->plugin_name),
    "%%user_phone%%"                        => __("User Phone", $this->plugin_name),
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%score%%"                             => __("Score", $this->plugin_name),
    "%%score_bar_chart%%"                   => __("Score bar chart", $this->plugin_name),
    "%%user_points%%"                       => __("User Point", $this->plugin_name),
    "%%user_corrects_count%%"               => __("Correct answers count", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%max_points%%"                        => __("Max point", $this->plugin_name),
    "%%user_points_bar_chart%%"             => __("User points bar chart", $this->plugin_name),
    "%%current_date%%"                      => __("Current Date", $this->plugin_name),
    "%%quiz_image%%"                        => __("Quiz Image", $this->plugin_name),
    "%%interval_message%%"                  => __("Interval message", $this->plugin_name),
    "%%avg_score%%"                         => __("Average score", $this->plugin_name),
    "%%avg_rate%%"                          => __("Average Rate", $this->plugin_name),
    "%%avg_rate_stars_with_icons%%"         => __("Average Rate with star icons", $this->plugin_name),
    "%%user_pass_time%%"                    => __("User passed time", $this->plugin_name),
    "%%quiz_time%%"                         => __("Quiz time", $this->plugin_name),
    "%%user_pass_time_bar_chart%%"          => __("User passed time bar chart", $this->plugin_name),
    "%%results_by_cats%%"                   => __("Results by question categories", $this->plugin_name),
    "%%results_by_cats_bar_chart%%"         => __("Results by question categories bar chart", $this->plugin_name),
    "%%unique_code%%"                       => __("Unique code", $this->plugin_name),
    "%%download_certificate%%"              => __("Download certificate button", $this->plugin_name),
    "%%wrong_answers_count%%"               => __("Wrong answers count (skipped questions are included)", $this->plugin_name),
    "%%only_wrong_answers_count%%"          => __("Only wrong answers count", $this->plugin_name),
    "%%avg_score_by_category%%"             => __("Average score by the question category", $this->plugin_name),
    "%%skipped_questions_count%%"           => __("Unanswered questions count", $this->plugin_name),
    "%%answered_questions_count%%"          => __("Answered questions count", $this->plugin_name),
    "%%detailed_result_column_chart%%"      => __("Detailed result of answered questions column chart", $this->plugin_name),
    "%%user_corrects_count_pie_chart%%"     => __("Count of answered questions pie chart", $this->plugin_name),
    "%%score_by_answered_questions%%"       => __("Score by answered questions", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%keyword_count_{keyword}%%"           => __("Keywords count", $this->plugin_name),
    "%%keyword_percentage_{keyword}%%"      => __("Keywords percentage", $this->plugin_name),
    "%%top_keywords_count_{count}%%"        => __("Top keywords count", $this->plugin_name),
    "%%top_keywords_percentage_{count}%%"   => __("Top keywords percentage", $this->plugin_name),
    "%%quiz_coupon%%"                       => __("Quiz coupon", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_quiz_page_link%%"            => __("Quiz page link", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%result_id%%"                         => __("User result ID", $this->plugin_name),
    "%%user_keyword_point_{keyword}%%"      => __("User keyword point", $this->plugin_name),
    "%%max_point_keyword_{keyword}%%"       => __("Max point keyword", $this->plugin_name),
    "%%user_keyword_percentage_{keyword}%%" => __("User keyword percentage", $this->plugin_name),
    "%%avg_user_points%%"                   => __("AVG User points", $this->plugin_name),
    "%%avg_res_by_cats%%"                   => __("AVG results by cats", $this->plugin_name),
    "%%avg_res_by_cats_bar_chart%%"         => __("AVG results by cats bar chart", $this->plugin_name),
    "%%results_by_tags%%"                   => __("Results by question tags", $this->plugin_name),
    "%%results_by_tags_bar_chart%%"         => __("Results by question tags bar chart", $this->plugin_name),
    "%%personality_result_by_question_ids_{CatID_1,CatID_2,CatID_3,CatID_4}%%"  => __("Personality result by question ids ", $this->plugin_name),
    "%%question_category_name_{question_cat_ID}%%"                              => __("Question Category Name", $this->plugin_name),
    "%%user_points_by_question_category_{question_cat_ID}%%"                    => __("User points by question category", $this->plugin_name),
    "%%user_max_point_by_question_category_{question_cat_ID}%%"                 => __("Max points by question category", $this->plugin_name),
    "%%question_category_displayed_questions_count_{question_cat_ID}%%"         => __("Displayed questions count by category", $this->plugin_name),
    "%%current_quiz_question_categories_count%%"                                => __("Question cateogries count", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_timer = array(
    "%%time%%"                              => __("Time", $this->plugin_name),
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_information_form = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_description = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_limitation_message = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_logged_in_users = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_only_selected_user_role = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_limitation_count_of_takers = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_password_for_passing_quiz = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_rating_form_title = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_schedule_pre_start_message = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);

$quiz_message_vars_review_thank_you_message = array(
    "%%quiz_name%%"                         => __("Quiz Title", $this->plugin_name),
    "%%user_first_name%%"                   => __("User's First Name", $this->plugin_name),
    "%%user_last_name%%"                    => __("User's Last Name", $this->plugin_name),
    "%%questions_count%%"                   => __("Questions count", $this->plugin_name),
    "%%user_nickname%%"                     => __("User's Nick Name", $this->plugin_name),
    "%%user_display_name%%"                 => __("User's Display Name", $this->plugin_name),
    "%%user_wordpress_email%%"              => __("User's WordPress profile email", $this->plugin_name),
    "%%user_wordpress_roles%%"              => __("User's WordPress Roles", $this->plugin_name),
    "%%quiz_creation_date%%"                => __("Quiz creation date", $this->plugin_name),
    "%%current_quiz_author%%"               => __("Quiz Author", $this->plugin_name),
    "%%current_user_ip%%"                   => __("User's IP Address", $this->plugin_name),
    "%%current_quiz_author_email%%"         => __("Quiz Author Email", $this->plugin_name),
    "%%current_quiz_author_nickname%%"      => __("Quiz Author Nickname", $this->plugin_name),
    "%%current_quiz_author_website_url%%"   => __("Quiz Author Website", $this->plugin_name),
    "%%admin_email%%"                       => __("Admin Email", $this->plugin_name),
    "%%home_page_url%%"                     => __("Home page URL", $this->plugin_name),
    "%%quiz_id%%"                           => __("Quiz ID", $this->plugin_name),
    "%%user_id%%"                           => __("User ID", $this->plugin_name),
    "%%site_title%%"                        => __("Site title", $this->plugin_name),
);


$quiz_message_vars_html                             = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars );
$quiz_message_vars_timer_html                       = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_timer );
$quiz_message_vars_information_form_html            = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_information_form );
$quiz_message_vars_description_html                 = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_description );
$quiz_message_vars_limitation_message_html          = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_limitation_message );
$quiz_message_vars_logged_in_users_html             = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_logged_in_users );
$quiz_message_vars_only_selected_user_role_html     = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_only_selected_user_role );
$quiz_message_vars_limitation_count_of_takers_html  = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_limitation_count_of_takers );
$quiz_message_vars_password_for_passing_quiz_html   = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_password_for_passing_quiz );
$quiz_message_vars_rating_form_title_html           = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_rating_form_title );
$quiz_message_vars_schedule_pre_start_message_html  = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_schedule_pre_start_message );
$quiz_message_vars_review_thank_you_message_html    = Quiz_Maker_Data::ays_quiz_generate_message_vars_html( $quiz_message_vars_review_thank_you_message );

$quiz_accordion_svg_html = '
<div class="ays-quiz-accordion-arrow-box">
    <svg class="ays-quiz-accordion-arrow ays-quiz-accordion-arrow-down" version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" overflow="visible" preserveAspectRatio="none" viewBox="0 0 24 24" width="32" height="32">
        <g>
            <path xmlns:default="http://www.w3.org/2000/svg" d="M8.59 16.34l4.58-4.59-4.58-4.59L10 5.75l6 6-6 6z" fill="#008cff" vector-effect="non-scaling-stroke" />
        </g>
    </svg>
</div>';

$quiz_password_trash_icon_svg_html = '
<span class="ays-quiz-password-trash-icon-box" data-type="password" title="'. __( 'Delete used passwords', 'quiz-maker') .'">
   <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_88_40)">
            <path d="M6.08929 1.81406L5.41071 2.8125H10.5893L9.91071 1.81406C9.85714 1.73672 9.76786 1.6875 9.67143 1.6875H6.325C6.22857 1.6875 6.13929 1.7332 6.08571 1.81406H6.08929ZM11.3393 0.878906L12.65 2.8125H13.1429H14.8571H15.1429C15.6179 2.8125 16 3.18867 16 3.65625C16 4.12383 15.6179 4.5 15.1429 4.5H14.8571V15.1875C14.8571 16.7414 13.5786 18 12 18H4C2.42143 18 1.14286 16.7414 1.14286 15.1875V4.5H0.857143C0.382143 4.5 0 4.12383 0 3.65625C0 3.18867 0.382143 2.8125 0.857143 2.8125H1.14286H2.85714H3.35L4.66071 0.875391C5.03214 0.330469 5.65714 0 6.325 0H9.67143C10.3393 0 10.9643 0.330469 11.3357 0.875391L11.3393 0.878906ZM2.85714 4.5V15.1875C2.85714 15.8098 3.36786 16.3125 4 16.3125H12C12.6321 16.3125 13.1429 15.8098 13.1429 15.1875V4.5H2.85714ZM5.71429 6.75V14.0625C5.71429 14.3719 5.45714 14.625 5.14286 14.625C4.82857 14.625 4.57143 14.3719 4.57143 14.0625V6.75C4.57143 6.44062 4.82857 6.1875 5.14286 6.1875C5.45714 6.1875 5.71429 6.44062 5.71429 6.75ZM8.57143 6.75V14.0625C8.57143 14.3719 8.31429 14.625 8 14.625C7.68571 14.625 7.42857 14.3719 7.42857 14.0625V6.75C7.42857 6.44062 7.68571 6.1875 8 6.1875C8.31429 6.1875 8.57143 6.44062 8.57143 6.75ZM11.4286 6.75V14.0625C11.4286 14.3719 11.1714 14.625 10.8571 14.625C10.5429 14.625 10.2857 14.3719 10.2857 14.0625V6.75C10.2857 6.44062 10.5429 6.1875 10.8571 6.1875C11.1714 6.1875 11.4286 6.44062 11.4286 6.75Z" fill="black"/>
        </g>
        <defs>
            <clipPath id="clip0_88_40">
                <rect width="16" height="18" fill="white"/>
            </clipPath>
        </defs>
    </svg>
</span>';

$quiz_coupon_trash_icon_svg_html = '
<span class="ays-quiz-coupon-trash-icon-box" data-type="coupon" title="'. __( 'Delete inactive coupons', 'quiz-maker') .'">
   <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_88_40)">
            <path d="M6.08929 1.81406L5.41071 2.8125H10.5893L9.91071 1.81406C9.85714 1.73672 9.76786 1.6875 9.67143 1.6875H6.325C6.22857 1.6875 6.13929 1.7332 6.08571 1.81406H6.08929ZM11.3393 0.878906L12.65 2.8125H13.1429H14.8571H15.1429C15.6179 2.8125 16 3.18867 16 3.65625C16 4.12383 15.6179 4.5 15.1429 4.5H14.8571V15.1875C14.8571 16.7414 13.5786 18 12 18H4C2.42143 18 1.14286 16.7414 1.14286 15.1875V4.5H0.857143C0.382143 4.5 0 4.12383 0 3.65625C0 3.18867 0.382143 2.8125 0.857143 2.8125H1.14286H2.85714H3.35L4.66071 0.875391C5.03214 0.330469 5.65714 0 6.325 0H9.67143C10.3393 0 10.9643 0.330469 11.3357 0.875391L11.3393 0.878906ZM2.85714 4.5V15.1875C2.85714 15.8098 3.36786 16.3125 4 16.3125H12C12.6321 16.3125 13.1429 15.8098 13.1429 15.1875V4.5H2.85714ZM5.71429 6.75V14.0625C5.71429 14.3719 5.45714 14.625 5.14286 14.625C4.82857 14.625 4.57143 14.3719 4.57143 14.0625V6.75C4.57143 6.44062 4.82857 6.1875 5.14286 6.1875C5.45714 6.1875 5.71429 6.44062 5.71429 6.75ZM8.57143 6.75V14.0625C8.57143 14.3719 8.31429 14.625 8 14.625C7.68571 14.625 7.42857 14.3719 7.42857 14.0625V6.75C7.42857 6.44062 7.68571 6.1875 8 6.1875C8.31429 6.1875 8.57143 6.44062 8.57143 6.75ZM11.4286 6.75V14.0625C11.4286 14.3719 11.1714 14.625 10.8571 14.625C10.5429 14.625 10.2857 14.3719 10.2857 14.0625V6.75C10.2857 6.44062 10.5429 6.1875 10.8571 6.1875C11.1714 6.1875 11.4286 6.44062 11.4286 6.75Z" fill="black"/>
        </g>
        <defs>
            <clipPath id="clip0_88_40">
                <rect width="16" height="18" fill="white"/>
            </clipPath>
        </defs>
    </svg>
</span>';

$save_as_default_button_tooltip = '
<a class="ays_help" data-toggle="tooltip" title="'. __( 'Saves the assigned settings of the current quiz as default. After clicking on this button, each time creating a new quiz, the system will take the settings and styles of the current quiz. If you want to change and renew it, please click on this button on another quiz.', 'quiz-maker' ) .'">
    <i class="ays_fa ays_fa_info_circle"></i>
</a>';

$navigation_bar_info_icon = '
<svg width="14" height="14" viewBox="0 0 14 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.5 6.25C3.5 5.25544 3.86875 4.30161 4.52513 3.59835C5.1815 2.89509 6.07174 2.5 7 2.5C7.92826 2.5 8.8185 2.89509 9.47487 3.59835C10.1313 4.30161 10.5 5.25544 10.5 6.25C10.5 7.24456 10.1313 8.19839 9.47487 8.90165C8.8185 9.60491 7.92826 10 7 10C6.07174 10 5.1815 9.60491 4.52513 8.90165C3.86875 8.19839 3.5 7.24456 3.5 6.25ZM0 17.5C0 16.1172 1.04271 15 2.33333 15H7C8.29062 15 9.33333 16.1172 9.33333 17.5V35H11.6667C12.9573 35 14 36.1172 14 37.5C14 38.8828 12.9573 40 11.6667 40H2.33333C1.04271 40 0 38.8828 0 37.5C0 36.1172 1.04271 35 2.33333 35H4.66667V20H2.33333C1.04271 20 0 18.8828 0 17.5Z" fill="black"/>
</svg>
        ';

$save_as_default_button_other_attributes = array( 'data-message' => __( 'Are you sure that you want to save these parameters as default?', 'quiz-maker' ) . "\n" . __( "Note: All the default values will be replaced with the current quiz settings and will be applied to the newly created quizzes.", 'quiz-maker' ) );

$style = null;
$image_text = __('Add Image', $this->plugin_name);
$bg_image_text = __('Add Image', $this->plugin_name);

$quiz_image = (isset( $quiz['quiz_image']  ) && $quiz['quiz_image'] != '') ? esc_url($quiz['quiz_image']) : "";

if ($quiz_image != '') {
    $style = "display: block;";
    $image_text = __('Edit Image', $this->plugin_name);
}

$get_all_quizzes = Quiz_Maker_Data::ays_quiz_ays_quiz_get_quizzes();

global $wp_roles;
global $wpdb;
$ays_users_roles = $wp_roles->roles;
$ays_users_search = array();
$db_prefix = is_multisite() ? $wpdb->base_prefix : $wpdb->prefix;

if( isset( $options['ays_users_search'] ) && !empty( $options['ays_users_search'] ) ){

    $users_table = esc_sql( $db_prefix . 'users' );

    $quiz_user_ids = implode( ",", $options['ays_users_search'] );

    $sql_users = "SELECT ID,display_name FROM {$users_table} WHERE ID IN (". $quiz_user_ids .")";

    $ays_users_search = $wpdb->get_results($sql_users, "ARRAY_A");
}

$all_attributes = $this->quizes_obj->get_al_attributes();
$quiz_attributes = (isset($options['quiz_attributes'])) ? $options['quiz_attributes'] : array();
$required_fields = (isset($options['required_fields'])) ? $options['required_fields'] : array();
$quiz_attributes_active_order = (isset($options['quiz_attributes_active_order'])) ? $options['quiz_attributes_active_order'] : array();
$quiz_attributes_passive_order = (isset($options['quiz_attributes_passive_order'])) ? $options['quiz_attributes_passive_order'] : array();
$default_attributes = array("ays_form_name", "ays_form_email", "ays_form_phone");
$quiz_attributes_checked = array();
$quiz_form_attrs = array();

if(isset($options['form_name']) && $options['form_name'] == 'on'){
    $quiz_attributes_checked[] = "ays_form_name";
}
if(isset($options['form_email']) && $options['form_email'] == 'on'){
    $quiz_attributes_checked[] = "ays_form_email";
}
if(isset($options['form_phone']) && $options['form_phone'] == 'on'){
    $quiz_attributes_checked[] = "ays_form_phone";
}

$quiz_form_attrs[] = array(
    "id" => null,
    "slug" => "ays_form_name",
    "name" => __( "Name", $this->plugin_name ),
    "type" => 'text'
);
$quiz_form_attrs[] = array(
    "id" => null,
    "slug" => "ays_form_email",
    "name" => __( "Email", $this->plugin_name ),
    "type" => 'email'
);
$quiz_form_attrs[] = array(
    "id" => null,
    "slug" => "ays_form_phone",
    "name" => __( "Phone", $this->plugin_name ),
    "type" => 'text'
);

$all_attributes = array_merge($quiz_form_attrs, $all_attributes);
$custom_fields = array();
foreach($all_attributes as $key => $attr){
    $attr_checked = in_array(strval($attr['id']), $quiz_attributes) ? 'checked' : '';
    $attr_required = in_array(strval($attr['id']), $required_fields) ? 'checked' : '';
    if(in_array($attr['slug'], $quiz_attributes_checked)){
        $attr_checked = 'checked';
    }
    if(in_array($attr['slug'], $required_fields)){
        $attr_required = 'checked';
    }
    $custom_fields[$attr['slug']] = array(
        'id' => $attr['id'],
        'name' => $attr['name'],
        'type' => $attr['type'],
        'slug' => $attr['slug'],
        'checked' => $attr_checked,
        'required' => $attr_required,
    );
}


$custom_fields_active = array();
$custom_fields_passive = array();
foreach($custom_fields as $key => $attr){
    if($attr['checked'] == 'checked'){
        $custom_fields_active[$attr['slug']] = $attr;
    }else{
        $custom_fields_passive[$attr['slug']] = $attr;
    }
}

uksort($custom_fields_active, function($key1, $key2) use ($quiz_attributes_active_order) {
	return ((array_search($key1, $quiz_attributes_active_order) > array_search($key2, $quiz_attributes_active_order)) ? 1 : -1);
});
uksort($custom_fields_passive, function($key1, $key2) use ($quiz_attributes_passive_order) {
	return ((array_search($key1, $quiz_attributes_passive_order) > array_search($key2, $quiz_attributes_passive_order)) ? 1 : -1);
});

$enable_pass_count = (isset($options['enable_pass_count'])) ? esc_attr( stripslashes($options['enable_pass_count']) ) : 'off';
$enable_timer = (isset($options['enable_timer'])) ? esc_attr( stripslashes($options['enable_timer']) ) : 'off';
$enable_quiz_rate = (isset($options['enable_quiz_rate'])) ? esc_attr( stripslashes($options['enable_quiz_rate']) ) : 'off';
$enable_rate_avg = (isset($options['enable_rate_avg'])) ? esc_attr( stripslashes($options['enable_rate_avg']) ) : 'off';
$enable_rate_comments = (isset($options['enable_rate_comments'])) ? esc_attr( stripslashes($options['enable_rate_comments']) ) : '';
$enable_copy_protection = (isset($options['enable_copy_protection'])) ? esc_attr( stripslashes($options['enable_copy_protection']) ) : '';

// Paypal
$enable_paypal = (isset($options['enable_paypal'])) ? $options['enable_paypal'] : '';
$paypal_amount = (isset($options['paypal_amount'])) ? $options['paypal_amount'] : '';
$paypal_currency = (isset($options['paypal_currency'])) ? $options['paypal_currency'] : '';
$paypal_message = (isset($options['paypal_message'])) ? $options['paypal_message'] : __('You need to pay to pass this quiz.', $this->plugin_name);
$paypal_message = stripslashes( $paypal_message );

// Stripe
$options['enable_stripe'] = !isset( $options['enable_stripe'] ) ? 'off' : $options['enable_stripe'];
$enable_stripe = ( isset($options['enable_stripe']) && $options['enable_stripe'] == 'on' ) ? true : false;
$stripe_amount = (isset($options['stripe_amount'])) ? $options['stripe_amount'] : '';
$stripe_currency = (isset($options['stripe_currency'])) ? $options['stripe_currency'] : '';
$stripe_message = (isset($options['stripe_message'])) ? $options['stripe_message'] : __('You need to pay to pass this quiz.', $this->plugin_name);
$stripe_message = stripslashes( $stripe_message );

// Paypal And Stripe Paymant type
$payment_type = (isset($options['payment_type']) && sanitize_text_field( $options['payment_type'] ) != '') ? sanitize_text_field( esc_attr( $options['payment_type']) ) : 'prepay';

// MailChimp
$enable_mailchimp = (isset($options['enable_mailchimp']) && $options['enable_mailchimp'] == 'on') ? true : false;
$mailchimp_list = (isset($options['mailchimp_list'])) ? $options['mailchimp_list'] : '';
$enable_double_opt_in = (isset($options['enable_double_opt_in']) && $options['enable_double_opt_in'] == 'on') ? true : false;

// Enable Tags by Interval
$options['enable_tags_interval'] = isset($options['enable_tags_interval']) ? $options['enable_tags_interval'] : 'off';
$enable_tags_interval = (isset($options['enable_tags_interval']) && $options['enable_tags_interval'] == 'on') ? true : false;

// Campaign Monitor
$enable_monitor = (isset($options['enable_monitor']) && $options['enable_monitor'] == 'on') ? true : false;
$monitor_list   = (isset($options['monitor_list'])) ? $options['monitor_list'] : '';

// Slack
$enable_slack       = (isset($options['enable_slack']) && $options['enable_slack'] == 'on') ? true : false;
$slack_conversation = (isset($options['slack_conversation'])) ? $options['slack_conversation'] : '';

// ActiveCampaign
$enable_active_camp     = (isset($options['enable_active_camp']) && $options['enable_active_camp'] == 'on') ? true : false;
$active_camp_list       = (isset($options['active_camp_list'])) ? $options['active_camp_list'] : '';
$active_camp_automation = (isset($options['active_camp_automation'])) ? $options['active_camp_automation'] : '';

// Zapier
$enable_zapier = (isset($options['enable_zapier']) && $options['enable_zapier'] == 'on') ? true : false;

// Google Sheets
$enable_google_sheets       = (isset($options['enable_google_sheets']) && $options['enable_google_sheets'] == 'on') ? true : false;

$enable_box_shadow = (!isset($options['enable_box_shadow'])) ? 'on' : $options['enable_box_shadow'];
$box_shadow_color = (!isset($options['box_shadow_color'])) ? '#c9c9c9' : esc_attr( stripslashes($options['box_shadow_color']) );
$quiz_border_radius = (isset($options['quiz_border_radius']) && $options['quiz_border_radius'] != '') ? $options['quiz_border_radius'] : '8';
$quiz_bg_image = (isset($options['quiz_bg_image']) && $options['quiz_bg_image'] != '') ? $options['quiz_bg_image'] : '';
$enable_border = (isset($options['enable_border']) && $options['enable_border'] == 'on') ? true : false;
$quiz_border_width = (isset($options['quiz_border_width']) && $options['quiz_border_width'] != '') ? $options['quiz_border_width'] : '1';
$quiz_border_style = (isset($options['quiz_border_style']) && $options['quiz_border_style'] != '') ? $options['quiz_border_style'] : 'solid';
$quiz_border_color = (isset($options['quiz_border_color']) && $options['quiz_border_color'] != '') ? esc_attr( stripslashes($options['quiz_border_color']) ) : '#000';
$quiz_timer_in_title = (isset($options['quiz_timer_in_title']) && $options['quiz_timer_in_title'] == 'on') ? true : false;
$enable_restart_button = (isset($options['enable_restart_button']) && $options['enable_restart_button'] == 'on') ? true : false;

$rate_form_title = (isset($options['rate_form_title'])) ? $options['rate_form_title'] : __('Please click the stars to rate the quiz', $this->plugin_name);
$quiz_loader = (isset($options['quiz_loader']) && $options['quiz_loader'] != '') ? $options['quiz_loader'] : 'default';

$quiz_create_date = (isset($quiz['create_date']) && $quiz['create_date'] != '') ? $quiz['create_date'] : "0000-00-00 00:00:00";

$main_quiz_url = (isset($quiz['quiz_url']) && esc_url($quiz['quiz_url']) != '') ? esc_url($quiz['quiz_url']) : '';

$autofill_user_data = (isset($options['autofill_user_data']) && $options['autofill_user_data'] == 'on') ? true : false;

$quest_animation = (isset($options['quest_animation'])) ? $options['quest_animation'] : "shake";
$enable_bg_music = (isset($options['enable_bg_music']) && $options['enable_bg_music'] == "on") ? true : false;
$quiz_bg_music = (isset($options['quiz_bg_music']) && $options['quiz_bg_music'] != "") ? $options['quiz_bg_music'] : "";
$answers_font_size = (isset($options['answers_font_size']) && $options['answers_font_size'] != "" && absint( esc_attr( $options['answers_font_size'] ) ) > 0) ? absint( esc_attr( $options['answers_font_size'] ) ) : '15';

// Strong calculation of checkbox answers
$options['checkbox_score_by'] = ! isset($options['checkbox_score_by']) ? 'on' : $options['checkbox_score_by'];
$checkbox_score_by = (isset($options['checkbox_score_by']) && $options['checkbox_score_by'] == "on") ? true : false;

$show_create_date = (isset($options['show_create_date']) && $options['show_create_date'] == "on") ? true : false;
$show_author = (isset($options['show_author']) && $options['show_author'] == "on") ? true : false;
$enable_early_finish = (isset($options['enable_early_finish']) && $options['enable_early_finish'] == "on") ? true : false;
$answers_rw_texts = (isset($options['answers_rw_texts']) && $options['answers_rw_texts'] != '') ? $options['answers_rw_texts'] : 'on_passing';
$disable_store_data = (isset($options['disable_store_data']) && $options['disable_store_data'] == 'on') ? true : false;


// Background gradient
$options['enable_background_gradient'] = (!isset($options['enable_background_gradient'])) ? 'off' : $options['enable_background_gradient'];
$enable_background_gradient = (isset($options['enable_background_gradient']) && $options['enable_background_gradient'] == 'on') ? true : false;
$background_gradient_color_1 = (isset($options['background_gradient_color_1']) && $options['background_gradient_color_1'] != '') ? esc_attr( stripslashes($options['background_gradient_color_1']) ) : '#000';
$background_gradient_color_2 = (isset($options['background_gradient_color_2']) && $options['background_gradient_color_2'] != '') ? esc_attr( stripslashes($options['background_gradient_color_2']) ) : '#fff';
$quiz_gradient_direction = (isset($options['quiz_gradient_direction']) && $options['quiz_gradient_direction'] != '') ? $options['quiz_gradient_direction'] : 'vertical';


//Schedule of Quiz
$options['active_date_check'] = isset($options['active_date_check']) ? $options['active_date_check'] : 'off';
$active_date_check = (isset($options['active_date_check']) && $options['active_date_check'] == 'on') ? true : false;
if ($active_date_check) {
	$activateTime   = strtotime($options['activeInterval']);
	$activeQuiz     = date('Y-m-d H:i:s', $activateTime);
	$deactivateTime = strtotime($options['deactiveInterval']);
	$deactiveQuiz   = date('Y-m-d H:i:s', $deactivateTime);
} else {
	$activeQuiz   = current_time( 'mysql' );
	$deactiveQuiz = current_time( 'mysql' );
}

// WooCommerce integration
$quiz_intervals_wc = in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));

$wc_for_js = "";
if($quiz_intervals_wc){
    $wc_for_js = "with-woo-product";
}

// Gamipress Integration
$quiz_intervals_gamipress = false;
$quiz_gamipress_logo_url = "";
if(function_exists('is_plugin_active') && is_plugin_active('quiz-maker-gamipress/quiz-maker-gamipress.php')){
    if(function_exists('is_plugin_active') && is_plugin_active('gamipress/gamipress.php')){
        $quiz_intervals_gamipress = true;
        if( defined( 'QUIZ_MAKER_GAMIPRESS_ADMIN_URL' ) ){
            $quiz_gamipress_logo_url = QUIZ_MAKER_GAMIPRESS_ADMIN_URL . "/images/integrations/gamipress_logo-2.png";
        }
    }
}

// Email configuration

$additional_emails = (isset($options['additional_emails']) && $options['additional_emails'] != '') ? $options['additional_emails'] : '';
$email_config_from_email = (isset($options['email_config_from_email']) && $options['email_config_from_email'] != '') ? $options['email_config_from_email'] : '';
$email_config_from_name = (isset($options['email_config_from_name']) && $options['email_config_from_name'] != '') ? stripslashes(htmlentities($options['email_config_from_name'], ENT_QUOTES, "UTF-8")) : '';
$email_config_from_subject = (isset($options['email_config_from_subject']) && $options['email_config_from_subject'] != '') ? stripslashes(htmlentities($options['email_config_from_subject'], ENT_QUOTES, "UTF-8")) : '';
$email_config_replyto_email = (isset($options['email_config_replyto_email']) && $options['email_config_replyto_email'] != '') ? $options['email_config_replyto_email'] : '';
$email_config_replyto_name = (isset($options['email_config_replyto_name']) && $options['email_config_replyto_name'] != '') ? stripslashes(htmlentities($options['email_config_replyto_name'], ENT_QUOTES, "UTF-8")) : '';

// Calculate the score option
$options['calculate_score'] = (!isset($options['calculate_score'])) ? 'by_correctness' : $options['calculate_score'];
$calculate_score = (isset($options['calculate_score']) && $options['calculate_score'] != '') ? $options['calculate_score'] : 'by_correctness';

// Quiz theme
$quiz_theme = isset($options['quiz_theme']) && $options['quiz_theme'] != "" ? $options['quiz_theme'] : 'classic_light';

// Redirect after submit
$options['redirect_after_submit'] = (!isset($options['redirect_after_submit'])) ? 'off' : $options['redirect_after_submit'];
$redirect_after_submit = isset($options['redirect_after_submit']) && $options['redirect_after_submit'] == 'on' ? true : false;
$submit_redirect_url = isset($options['submit_redirect_url']) ? $options['submit_redirect_url'] : '';
$submit_redirect_delay = (isset($options['submit_redirect_delay']) && $options['submit_redirect_delay'] != "") ? esc_attr( absint($options['submit_redirect_delay']) ) : '';
// Progress bar style
$progress_bar_style = (isset($options['progress_bar_style']) && $options['progress_bar_style'] != "") ? $options['progress_bar_style'] : 'third';

// Exit button in finish page
$options['enable_exit_button'] = (!isset($options['enable_exit_button'])) ? 'off' : $options['enable_exit_button'];
$enable_exit_button = isset($options['enable_exit_button']) && $options['enable_exit_button'] == 'on' ? true : false;
$exit_redirect_url = isset($options['exit_redirect_url']) ? $options['exit_redirect_url'] : '';

// Question image sizing
$image_sizing = (isset($options['image_sizing']) && $options['image_sizing'] != "") ? $options['image_sizing'] : 'cover';

// Quiz background image position
$quiz_bg_image_position = (isset($options['quiz_bg_image_position']) && $options['quiz_bg_image_position'] != "") ? $options['quiz_bg_image_position'] : 'center center';

// Custom class for quiz container
$custom_class = (isset($options['custom_class']) && $options['custom_class'] != "") ? $options['custom_class'] : '';

// Social Media links
$enable_social_links = (isset($options['enable_social_links']) && $options['enable_social_links'] == "on") ? true : false;
$social_links = (isset($options['social_links'])) ? $options['social_links'] : array(
    'linkedin_link' => '',
    'facebook_link' => '',
    'twitter_link' => '',
    'vkontakte_link' => '',
    'instagram_link' => '',
    'youtube_link' => '',
    'behance_link' => '',
);
$linkedin_link = isset($social_links['linkedin_link']) && $social_links['linkedin_link'] != '' ? esc_url($social_links['linkedin_link']) : '';
$facebook_link = isset($social_links['facebook_link']) && $social_links['facebook_link'] != '' ? esc_url($social_links['facebook_link']) : '';
$twitter_link = isset($social_links['twitter_link']) && $social_links['twitter_link'] != '' ? esc_url($social_links['twitter_link']) : '';
$vkontakte_link = isset($social_links['vkontakte_link']) && $social_links['vkontakte_link'] != '' ? esc_url($social_links['vkontakte_link']) : '';
$instagram_link = isset($social_links['instagram_link']) && $social_links['instagram_link'] != '' ? esc_url($social_links['instagram_link']) : '';
$youtube_link = isset($social_links['youtube_link']) && $social_links['youtube_link'] != '' ? esc_url($social_links['youtube_link']) : '';
$behance_link = isset($social_links['behance_link']) && $social_links['behance_link'] != '' ? esc_url($social_links['behance_link']) : '';

// Show quiz head information
// Show quiz title and description
$options['show_quiz_title'] = isset($options['show_quiz_title']) ? $options['show_quiz_title'] : 'on';
$options['show_quiz_desc'] = isset($options['show_quiz_desc']) ? $options['show_quiz_desc'] : 'on';
$show_quiz_title = (isset($options['show_quiz_title']) && $options['show_quiz_title'] == "on") ? true : false;
$show_quiz_desc = (isset($options['show_quiz_desc']) && $options['show_quiz_desc'] == "on") ? true : false;


// Show login form for not logged in users
$options['show_login_form'] = isset($options['show_login_form']) ? $options['show_login_form'] : 'off';
$show_login_form = (isset($options['show_login_form']) && $options['show_login_form'] == "on") ? true : false;


// Quiz container max-width for mobile
$mobile_max_width = (isset($options['mobile_max_width']) && $options['mobile_max_width'] != "") ? $options['mobile_max_width'] : '';


// Quiz theme
$quiz_theme = (isset($options['quiz_theme']) && $options['quiz_theme'] != '') ? $options['quiz_theme'] : 'classic_light';


// Limit users by option
$limit_users_by = (isset($options['limit_users_by']) && $options['limit_users_by'] != '') ? $options['limit_users_by'] : 'ip';

//Send results to user
$options['send_results_user'] = !isset($options['send_results_user']) ? 'off' : $options['send_results_user'];
$send_results_user = isset($options['send_results_user']) && $options['send_results_user'] == 'on' ? 'checked' : '';

//Send interval message to user
$options['send_interval_msg'] = !isset($options['send_interval_msg']) ? 'off' : $options['send_interval_msg'];
$send_interval_msg = isset($options['send_interval_msg']) && $options['send_interval_msg'] == 'on' ? 'checked' : '';

// Question bank options
// Question bank type
$question_bank_type = (isset($options['question_bank_type']) && $options['question_bank_type'] != '') ? $options['question_bank_type'] : 'general';
$questions_bank_cat_count = (isset($options['questions_bank_cat_count']) && !empty($options['questions_bank_cat_count'])) ? $options['questions_bank_cat_count'] : array();

foreach($question_bank_categories as $cid => $cat){
    if(! array_key_exists($cid, $questions_bank_cat_count)){
        $questions_bank_cat_count[$cid] = '';
    }
}

// Limitation tackers of quiz
$options['enable_tackers_count'] = !isset($options['enable_tackers_count']) ? 'off' : $options['enable_tackers_count'];
$enable_tackers_count = (isset($options['enable_tackers_count']) && $options['enable_tackers_count'] == 'on') ? true : false;
$tackers_count = (isset($options['tackers_count']) && $options['tackers_count'] != '') ? $options['tackers_count'] : '';

//AV Get post categories
$cat_list = get_categories(
    array(
        'hide_empty' => false,
    )
);


// Right/wrong answer text showing time option
$explanation_time = (isset($options['explanation_time']) && $options['explanation_time'] != '') ? $options['explanation_time'] : '4';

// Enable claer answer button
$options['enable_clear_answer'] = isset($options['enable_clear_answer']) ? $options['enable_clear_answer'] : 'off';
$enable_clear_answer = (isset($options['enable_clear_answer']) && $options['enable_clear_answer'] == "on") ? true : false;

//Send results to admin
$options['send_results_admin'] = !isset($options['send_results_admin']) ? 'on' : $options['send_results_admin'];
$send_results_admin = isset($options['send_results_admin']) && $options['send_results_admin'] == 'on' ? 'checked' : '';

//Send interval message to admin
$options['send_interval_msg_to_admin'] = !isset($options['send_interval_msg_to_admin']) ? 'off' : $options['send_interval_msg_to_admin'];
$send_interval_msg_to_admin = isset($options['send_interval_msg_to_admin']) && $options['send_interval_msg_to_admin'] == 'on' ? 'checked' : '';

// Show quiz category
$options['show_category'] = isset($options['show_category']) ? $options['show_category'] : 'off';
$show_category = (isset($options['show_category']) && $options['show_category'] == "on") ? true : false;

// Show question category
$options['show_question_category'] = isset($options['show_question_category']) ? $options['show_question_category'] : 'off';
$show_question_category = (isset($options['show_question_category']) && $options['show_question_category'] == "on") ? true : false;

/*
 * Answers images styles
 **********************************************
 */
// Answers padding option
$answers_padding = (isset($options['answers_padding']) && $options['answers_padding'] != '') ? $options['answers_padding'] : '5';
// Answers margin option
$answers_margin = (isset($options['answers_margin']) && $options['answers_margin'] != '') ? $options['answers_margin'] : '12';
// Answers border options
$options['answers_border'] = (isset($options['answers_border'])) ? $options['answers_border'] : 'on';
$answers_border = (isset($options['answers_border']) && $options['answers_border'] == 'on') ? true : false;
$answers_border_width = (isset($options['answers_border_width']) && $options['answers_border_width'] != '') ? $options['answers_border_width'] : '1';
$answers_border_style = (isset($options['answers_border_style']) && $options['answers_border_style'] != '') ? $options['answers_border_style'] : 'solid';
$answers_border_color = (isset($options['answers_border_color']) && $options['answers_border_color'] != '') ? esc_attr( stripslashes($options['answers_border_color']) ) : '#dddddd';

$answers_box_shadow = (isset($options['answers_box_shadow']) && $options['answers_box_shadow'] == 'on') ? true : false;
$answers_box_shadow_color = (isset($options['answers_box_shadow_color']) && $options['answers_box_shadow_color'] != '') ? esc_attr( stripslashes($options['answers_box_shadow_color']) ) : '#000';

// Answers image options
$ans_img_height = (isset($options['ans_img_height']) && $options['ans_img_height'] != '') ? $options['ans_img_height'] : '150';
$ans_img_caption_style = (isset($options['ans_img_caption_style']) && $options['ans_img_caption_style'] != '') ? $options['ans_img_caption_style'] : 'outside';
$ans_img_caption_position = (isset($options['ans_img_caption_position']) && $options['ans_img_caption_position'] != '') ? $options['ans_img_caption_position'] : 'bottom';

// Show answers caption
$options['show_answers_caption'] = isset($options['show_answers_caption']) ? $options['show_answers_caption'] : 'on';
$show_answers_caption = (isset($options['show_answers_caption']) && $options['show_answers_caption'] == 'on') ? true : false;

// Answers right/wrong answers icons
$ans_right_wrong_icon = (isset($options['ans_right_wrong_icon']) && $options['ans_right_wrong_icon'] != '') ? $options['ans_right_wrong_icon'] : 'none';

/*************************************************/

// Show interval message
$options['show_interval_message'] = isset($options['show_interval_message']) ? $options['show_interval_message'] : 'on';
$show_interval_message = (isset($options['show_interval_message']) && $options['show_interval_message'] == 'on') ? true : false;

// Apply points to keywords
$options['apply_points_to_keywords'] = isset($options['apply_points_to_keywords']) ? $options['apply_points_to_keywords'] : 'off';
$apply_points_to_keywords = (isset($options['apply_points_to_keywords']) && $options['apply_points_to_keywords'] == 'on') ? true : false;

// Display score option
$display_score = (isset($options['display_score']) && $options['display_score'] != "") ? $options['display_score'] : 'by_percentage';

// Right / Wrong answers sound option
$options['enable_rw_asnwers_sounds'] = isset($options['enable_rw_asnwers_sounds']) ? $options['enable_rw_asnwers_sounds'] : 'off';
$enable_rw_asnwers_sounds = (isset($options['enable_rw_asnwers_sounds']) && $options['enable_rw_asnwers_sounds'] == "on") ? true : false;

// Allow collecting logged in users data
$options['allow_collecting_logged_in_users_data'] = isset($options['allow_collecting_logged_in_users_data']) ? $options['allow_collecting_logged_in_users_data'] : 'off';
$allow_collecting_logged_in_users_data = (isset($options['allow_collecting_logged_in_users_data']) && $options['allow_collecting_logged_in_users_data'] == "on") ? true : false;

// Pass score of the quiz
$quiz_pass_score = (isset($options['quiz_pass_score']) && $options['quiz_pass_score'] != "") ? $options['quiz_pass_score'] : 0;

// Hide quiz background image on the result page
$options['quiz_bg_img_in_finish_page'] = isset($options['quiz_bg_img_in_finish_page']) ? $options['quiz_bg_img_in_finish_page'] : 'off';
$quiz_bg_img_in_finish_page = (isset($options['quiz_bg_img_in_finish_page']) && $options['quiz_bg_img_in_finish_page'] == "on") ? true : false;

// Finish the quiz after making one wrong answer
$options['finish_after_wrong_answer'] = isset($options['finish_after_wrong_answer']) ? $options['finish_after_wrong_answer'] : 'off';
$finish_after_wrong_answer = (isset($options['finish_after_wrong_answer']) && $options['finish_after_wrong_answer'] == "on") ? true : false;

// Text after timer ends
$after_timer_text = (isset($options['after_timer_text']) && $options['after_timer_text'] != '') ? wpautop(stripslashes($options['after_timer_text'])) : '';

// Send certificate to admin too
$options['send_certificate_to_admin'] = isset($options['send_certificate_to_admin']) ? $options['send_certificate_to_admin'] : 'off';
$ays_send_certificate_to_admin = (isset($options['send_certificate_to_admin']) && $options['send_certificate_to_admin'] == "on") ? true : false;

// Use subject for the admin email
$options['use_subject_for_admin_email'] = isset($options['use_subject_for_admin_email']) ? $options['use_subject_for_admin_email'] : 'off';
$use_subject_for_admin_email = (isset($options['use_subject_for_admin_email']) && $options['use_subject_for_admin_email'] == "on") ? true : false;

// Enable certificate
$options['enable_certificate'] = isset($options['enable_certificate']) ? $options['enable_certificate'] : 'off';
$ays_enable_certificate = (isset($options['enable_certificate']) && $options['enable_certificate'] == "on") ? true : false;

// Enable certificate without send
$options['enable_certificate_without_send'] = isset($options['enable_certificate_without_send']) ? $options['enable_certificate_without_send'] : 'off';
$ays_enable_certificate_without_send = (isset($options['enable_certificate_without_send']) && $options['enable_certificate_without_send'] == "on") ? true : false;

// Enable to go next by pressing Enter key
$options['enable_enter_key'] = isset($options['enable_enter_key']) ? $options['enable_enter_key'] : 'on';
$enable_enter_key = (isset($options['enable_enter_key']) && $options['enable_enter_key'] == "on") ? true : false;

// Certificate title
$certificate_title = wpautop(stripslashes((isset($options['certificate_title'])) ? $options['certificate_title'] : ''));

// Certificate body
$certificate_body = wpautop(stripslashes((isset($options['certificate_body'])) ? $options['certificate_body'] : ''));

// Certificate background image
$certificate_image = (isset($options['certificate_image']) && $options['certificate_image'] != '') ? $options['certificate_image'] : '';

// Certificate background frame
$certificate_frame = (isset($options['certificate_frame']) && $options['certificate_frame'] != '') ? $options['certificate_frame'] : 'default';

$pdfapi_url = "https://ays-pro.com/pdfapi"; // rtrim(AYS_QUIZ_BASE_URL, '/') . '-pdfapi/pdfapi/',
//$pdfapi_url = "http://localhost/pdfapi";
$certificate_frames_url = apply_filters( 'ays_quiz_pdfapi_api_url', $pdfapi_url );
$certificate_frames_url = rtrim($certificate_frames_url, '/') . '/frames/';

// Certificate orientation
$certificate_orientation = (isset($options['certificate_orientation']) && $options['certificate_orientation'] != '') ? $options['certificate_orientation'] : 'l';

// Make the questions required
$options['make_questions_required'] = isset($options['make_questions_required']) ? $options['make_questions_required'] : 'off';
$make_questions_required = (isset($options['make_questions_required']) && $options['make_questions_required'] == "on") ? true : false;

// Show average rate after rate
$options['show_rate_after_rate'] = isset($options['show_rate_after_rate']) ? $options['show_rate_after_rate'] : 'on';
$show_rate_after_rate = (isset($options['show_rate_after_rate']) && $options['show_rate_after_rate'] == "on") ? true : false;

// Text color
$text_color = (isset($options['text_color']) && $options['text_color'] != '') ? esc_attr( stripslashes($options['text_color']) ) : '#000000';

// Buttons text color
$buttons_text_color = (isset($options['buttons_text_color']) && $options['buttons_text_color'] != '') ? esc_attr( stripslashes($options['buttons_text_color']) ) : $text_color;

// Buttons position
$buttons_position = (isset($options['buttons_position']) && $options['buttons_position'] != '') ? $options['buttons_position'] : 'center';

// Password quiz
$options['enable_password'] = !isset($options['enable_password']) ? 'off' : $options['enable_password'];
$enable_password = (isset($options['enable_password']) && $options['enable_password'] == 'on') ? true : false;
$password_quiz = (isset($options['password_quiz']) && $options['password_quiz'] != '') ? $options['password_quiz'] : '';

$mail_message_admin = (isset($options['mail_message_admin']) && $options['mail_message_admin'] != '') ? wpautop(stripslashes($options['mail_message_admin'])) : '';

// Enable audio autoplay
$enable_audio_autoplay = (isset($options['enable_audio_autoplay']) && $options['enable_audio_autoplay'] == 'on') ? true : false;

// =========== Buttons Styles Start ===========

// Buttons size
$buttons_size = (isset($options['buttons_size']) && $options['buttons_size'] != "") ? $options['buttons_size'] : 'large';

// Buttons font size
$buttons_font_size = (isset($options['buttons_font_size']) && $options['buttons_font_size'] != "") ? $options['buttons_font_size'] : '18';

// Buttons Left / Right padding
$buttons_left_right_padding = (isset($options['buttons_left_right_padding']) && $options['buttons_left_right_padding'] != '') ? $options['buttons_left_right_padding'] : '36';

// Buttons Top / Bottom padding
$buttons_top_bottom_padding = (isset($options['buttons_top_bottom_padding']) && $options['buttons_top_bottom_padding'] != '') ? $options['buttons_top_bottom_padding'] : '14';

// Buttons border radius
$buttons_border_radius = (isset($options['buttons_border_radius']) && $options['buttons_border_radius'] != "") ? $options['buttons_border_radius'] : '8';

// Buttons font size
$buttons_width = (isset($options['buttons_width']) && $options['buttons_width'] != "") ? $options['buttons_width'] : '';

// =========== Buttons Styles End ===========

//Send mail to site admin
$options['send_mail_to_site_admin'] = !isset($options['send_mail_to_site_admin']) ? 'on' : $options['send_mail_to_site_admin'];
$send_mail_to_site_admin = isset($options['send_mail_to_site_admin']) && $options['send_mail_to_site_admin'] == 'on' ? 'checked' : '';

// Enable leave page
$options['enable_leave_page'] = isset($options['enable_leave_page']) ? $options['enable_leave_page'] : 'on';
$enable_leave_page = (isset($options['enable_leave_page']) && $options['enable_leave_page'] == "on") ? true : false;

// Show only wrong answer
$options['show_only_wrong_answer'] = isset($options['show_only_wrong_answer']) ? $options['show_only_wrong_answer'] : 'off';
$show_only_wrong_answer = (isset($options['show_only_wrong_answer']) && $options['show_only_wrong_answer'] == "on") ? true : false;

// Pass Score
$pass_score = (isset($options['pass_score']) && $options['pass_score'] != '') ? absint(intval($options['pass_score'])) : '0';

// Quiz pass message
$pass_score_message = isset($options['pass_score_message']) ? stripslashes($options['pass_score_message']) : '<h4 style="text-align: center;">'. __("Congratulations!", $this->plugin_name) .'</h4><p style="text-align: center;">'. __("You passed the quiz!", $this->plugin_name) .'</p>';

// Quiz pass message
$fail_score_message = isset($options['fail_score_message']) ? stripslashes($options['fail_score_message']) : '<h4 style="text-align: center;">'. __("Oops!", $this->plugin_name) .'</h4><p style="text-align: center;">'. __("You have not passed the quiz! <br> Try again!", $this->plugin_name) .'</p>';

// Maximum pass score of the quiz
$quiz_max_pass_count = (isset($options['quiz_max_pass_count']) && $options['quiz_max_pass_count'] != "") ?  absint(intval($options['quiz_max_pass_count'])) : 1;

// Question Font Size
$question_font_size = (isset($options['question_font_size']) && $options['question_font_size'] != '' && absint(esc_attr($options['question_font_size'])) > 0) ? absint(esc_attr($options['question_font_size'])) : '16';

// Quiz Width by percentage or pixels
$quiz_width_by_percentage_px = (isset($options['quiz_width_by_percentage_px']) && $options['quiz_width_by_percentage_px'] != '') ? $options['quiz_width_by_percentage_px'] : 'pixels';

// Text instead of question hint
$questions_hint_icon_or_text = (isset($options['questions_hint_icon_or_text']) && $options['questions_hint_icon_or_text'] != '') ? $options['questions_hint_icon_or_text'] : 'default';
$questions_hint_value = (isset($options['questions_hint_value']) && $options['questions_hint_value'] != '') ? stripslashes(esc_attr($options['questions_hint_value'])) : '';

// Generated password
$ays_passwords_quiz = (isset($options['generate_password']) && $options['generate_password'] != '') ? $options['generate_password'] : 'general';
$generated_passwords = (isset($options['generated_passwords']) && $options['generated_passwords'] != '') ? $options['generated_passwords'] : array();
if(!empty($generated_passwords)){
    $created_passwords = (isset( $generated_passwords['created_passwords']) && !empty( $generated_passwords['created_passwords'])) ?  $generated_passwords['created_passwords'] : array();
    $active_passwords = (isset( $generated_passwords['active_passwords']) && !empty( $generated_passwords['active_passwords'])) ?  $generated_passwords['active_passwords'] : array();
    $used_passwords = (isset( $generated_passwords['used_passwords']) && !empty( $generated_passwords['used_passwords'])) ?  $generated_passwords['used_passwords'] : array();
}

// Display score by
$display_score_by = (isset($options['display_score_by']) && $options['display_score_by'] != '') ? $options['display_score_by'] : 'by_percentage';

// Show schedule timer
$options['show_schedule_timer'] = isset($options['show_schedule_timer']) ? $options['show_schedule_timer'] : 'off';
$schedule_show_timer = (isset($options['show_schedule_timer']) && $options['show_schedule_timer'] == 'on') ? true : false;
$show_timer_type = isset($options['show_timer_type']) && $options['show_timer_type'] != '' ? $options['show_timer_type'] : 'countdown';


$keyword_default_max_value = isset($settings_options['keyword_default_max_value']) ? $settings_options['keyword_default_max_value'] : null;
if($keyword_default_max_value === null){
    $keyword_default_max_value = 26;
}
$keyword_arr = $this->ays_quiz_generate_keyword_array( $keyword_default_max_value );

wp_localize_script( $this->plugin_name . "-functions", 'aysQuizKewordsArray', $keyword_arr );

// Enable Finish Button Comfirm Box
$options['enable_early_finsh_comfirm_box'] = isset($options['enable_early_finsh_comfirm_box']) ? $options['enable_early_finsh_comfirm_box'] : 'on';
$enable_early_finsh_comfirm_box = (isset($options['enable_early_finsh_comfirm_box']) && $options['enable_early_finsh_comfirm_box'] == "on") ? true : false;

// Enable Negative Mark
//$options['enable_negative_mark'] = isset($options['enable_negative_mark']) ? $options['enable_negative_mark'] : 'off';
//$enable_negative_mark = (isset($options['enable_negative_mark']) && $options['enable_negative_mark'] == 'on') ? true : false;

// Negative Mark Point
//$negative_mark_point = (isset($options['negative_mark_point']) && $options['negative_mark_point'] != '') ? abs($options['negative_mark_point']) : 0;

// Progress live bar style
$progress_live_bar_style = (isset($options['progress_live_bar_style']) && $options['progress_live_bar_style'] != "") ? $options['progress_live_bar_style'] : 'default';

// Show all questions result in finish page
$options['enable_questions_result'] = isset($options['enable_questions_result']) ? $options['enable_questions_result'] : 'off';
$enable_questions_result = (isset($options['enable_questions_result']) && $options['enable_questions_result'] == 'on') ? true : false;

// Hide correct answers
$options['hide_correct_answers'] = isset($options['hide_correct_answers']) ? $options['hide_correct_answers'] : 'off';
$hide_correct_answers = (isset($options['hide_correct_answers']) && $options['hide_correct_answers'] == 'on') ? true : false;

// Quiz loader text value
$quiz_loader_text_value = (isset($options['quiz_loader_text_value']) && $options['quiz_loader_text_value'] != '') ? stripslashes(esc_attr($options['quiz_loader_text_value'])) : '';

// Show information form to logged in users
$options['show_information_form'] = isset($options['show_information_form']) ? $options['show_information_form'] : 'on';
$show_information_form = (isset($options['show_information_form']) && $options['show_information_form'] == 'on') ? true : false;

// Show questions explanation on
$show_questions_explanation = (isset($options['show_questions_explanation']) && $options['show_questions_explanation'] != '') ? $options['show_questions_explanation'] : 'on_results_page';

// Enable questions ordering by category
$options['enable_questions_ordering_by_cat'] = isset($options['enable_questions_ordering_by_cat']) ? $options['enable_questions_ordering_by_cat'] : 'off';
$enable_questions_ordering_by_cat = (isset($options['enable_questions_ordering_by_cat']) && $options['enable_questions_ordering_by_cat'] == "on") ? true : false;

// Send mail to USER by pass score
$options['enable_send_mail_to_user_by_pass_score'] = isset($options['enable_send_mail_to_user_by_pass_score']) ? $options['enable_send_mail_to_user_by_pass_score'] : 'off';
$enable_send_mail_to_user_by_pass_score = (isset($options['enable_send_mail_to_user_by_pass_score']) && $options['enable_send_mail_to_user_by_pass_score'] == "on") ? true : false;

// Send mail to ADMIN by pass score
$options['enable_send_mail_to_admin_by_pass_score'] = isset($options['enable_send_mail_to_admin_by_pass_score']) ? $options['enable_send_mail_to_admin_by_pass_score'] : 'off';
$enable_send_mail_to_admin_by_pass_score = (isset($options['enable_send_mail_to_admin_by_pass_score']) && $options['enable_send_mail_to_admin_by_pass_score'] == "on") ? true : false;

// Show questions numbering
$show_questions_numbering = (isset($options['show_questions_numbering']) && $options['show_questions_numbering'] != '') ? $options['show_questions_numbering'] : 'none';

// Show answers numbering
$show_answers_numbering = (isset($options['show_answers_numbering']) && $options['show_answers_numbering'] != '') ? $options['show_answers_numbering'] : 'none';

// Quiz loader custom gif value
$quiz_loader_custom_gif = (isset($options['quiz_loader_custom_gif']) && $options['quiz_loader_custom_gif'] != '') ? stripslashes(esc_url($options['quiz_loader_custom_gif'])) : '';

// Disable answer hover
$options['disable_hover_effect'] = isset($options['disable_hover_effect']) ? $options['disable_hover_effect'] : 'off';
$disable_hover_effect = (isset($options['disable_hover_effect']) && $options['disable_hover_effect'] == 'on') ? true : false;

// Quiz loader custom gif width
$quiz_loader_custom_gif_width = (isset($options['quiz_loader_custom_gif_width']) && $options['quiz_loader_custom_gif_width'] != '') ? absint( intval( $options['quiz_loader_custom_gif_width'] ) ) : 100;

// Quiz title transformation
$quiz_title_transformation = (isset($options['quiz_title_transformation']) && sanitize_text_field($options['quiz_title_transformation']) != "") ? sanitize_text_field($options['quiz_title_transformation']) : 'uppercase';

// Image Width(px)
$image_width = (isset($options['image_width']) && sanitize_text_field($options['image_width']) != '') ? absint( sanitize_text_field($options['image_width']) ) : '';

// Quiz image width percentage/px
$quiz_image_width_by_percentage_px = (isset($options['quiz_image_width_by_percentage_px']) && sanitize_text_field( $options['quiz_image_width_by_percentage_px'] ) != '') ? sanitize_text_field( $options['quiz_image_width_by_percentage_px'] ) : 'pixels';

// Quiz image height
$quiz_image_height = (isset($options['quiz_image_height']) && sanitize_text_field($options['quiz_image_height']) != '') ? absint( sanitize_text_field($options['quiz_image_height']) ) : '';

// Hide background image on start page
$options['quiz_bg_img_on_start_page'] = isset($options['quiz_bg_img_on_start_page']) ? $options['quiz_bg_img_on_start_page'] : 'off';
$quiz_bg_img_on_start_page = (isset($options['quiz_bg_img_on_start_page']) && $options['quiz_bg_img_on_start_page'] == 'on') ? true : false;

//  Box Shadow X offset
$quiz_box_shadow_x_offset = (isset($options['quiz_box_shadow_x_offset']) && $options['quiz_box_shadow_x_offset'] != '' && intval( $options['quiz_box_shadow_x_offset'] ) != 0) ? intval( $options['quiz_box_shadow_x_offset'] ) : 0;

//  Box Shadow Y offset
$quiz_box_shadow_y_offset = (isset($options['quiz_box_shadow_y_offset']) && $options['quiz_box_shadow_y_offset'] != '' && intval( $options['quiz_box_shadow_y_offset'] ) != 0) ? intval( $options['quiz_box_shadow_y_offset'] ) : 0;

//  Box Shadow Z offset
$quiz_box_shadow_z_offset = (isset($options['quiz_box_shadow_z_offset']) && $options['quiz_box_shadow_z_offset'] != '' && intval( $options['quiz_box_shadow_z_offset'] ) != 0) ? intval( $options['quiz_box_shadow_z_offset'] ) : 15;

// Question text alignment
$quiz_question_text_alignment = (isset($options['quiz_question_text_alignment']) && sanitize_text_field( $options['quiz_question_text_alignment'] ) != '') ? sanitize_text_field( $options['quiz_question_text_alignment'] ) : 'center';

// Quiz arrows option arrows
$quiz_arrow_type = (isset($options['quiz_arrow_type']) && ( $options['quiz_arrow_type'] ) != '') ? ( $options['quiz_arrow_type'] ) : 'default';

// Show wrong answers first
$options['quiz_show_wrong_answers_first'] = isset($options['quiz_show_wrong_answers_first']) ? sanitize_text_field($options['quiz_show_wrong_answers_first']) : 'off';
$quiz_show_wrong_answers_first = (isset($options['quiz_show_wrong_answers_first']) && $options['quiz_show_wrong_answers_first'] == 'on') ? true : false;

//Enable Full Screen Mode
$options['enable_full_screen_mode'] = isset($options['enable_full_screen_mode']) ? $options['enable_full_screen_mode'] : 'off';
$enable_full_screen_mode = (isset($options['enable_full_screen_mode']) && $options['enable_full_screen_mode'] == 'on') ? true : false;

//Enable navigation bar
$options['enable_navigation_bar'] = isset($options['enable_navigation_bar']) ? $options['enable_navigation_bar'] : 'off';
$enable_navigation_bar = (isset($options['enable_navigation_bar']) && $options['enable_navigation_bar'] == 'on') ? true : false;

// Display all questions on one page
$options['quiz_display_all_questions'] = isset($options['quiz_display_all_questions']) ? sanitize_text_field($options['quiz_display_all_questions']) : 'off';
$quiz_display_all_questions = (isset($options['quiz_display_all_questions']) && $options['quiz_display_all_questions'] == 'on') ? true : false;

// Turn red warning
$options['quiz_timer_red_warning'] = isset($options['quiz_timer_red_warning']) ? sanitize_text_field($options['quiz_timer_red_warning']) : 'off';
$quiz_timer_red_warning = (isset($options['quiz_timer_red_warning']) && $options['quiz_timer_red_warning'] == 'on') ? true : false;

// Timezone | Schedule the quiz
$ays_quiz_schedule_timezone = (isset($options['quiz_schedule_timezone']) && $options['quiz_schedule_timezone'] != '') ? sanitize_text_field( $options['quiz_schedule_timezone'] ) : get_option( 'timezone_string' );

// Remove old Etc mappings. Fallback to gmt_offset.
if ( strpos( $ays_quiz_schedule_timezone, 'Etc/GMT' ) !== false ) {
    $ays_quiz_schedule_timezone = '';
}

$current_offset = get_option( 'gmt_offset' );
if ( empty( $ays_quiz_schedule_timezone ) ) { // Create a UTC+- zone if no timezone string exists.

    if ( 0 == $current_offset ) {
        $ays_quiz_schedule_timezone = 'UTC+0';
    } elseif ( $current_offset < 0 ) {
        $ays_quiz_schedule_timezone = 'UTC' . $current_offset;
    } else {
        $ays_quiz_schedule_timezone = 'UTC+' . $current_offset;
    }
}

// Hint icon | Button | Text Value
$questions_hint_button_value = (isset($options['questions_hint_button_value']) && sanitize_text_field( $options['questions_hint_button_value'] ) != '') ? sanitize_text_field( esc_attr( $options['questions_hint_button_value']) ) : '';

// Quiz takers message
$quiz_tackers_message = ( isset($options['quiz_tackers_message']) && $options['quiz_tackers_message'] != '' ) ? stripslashes( wpautop( $options['quiz_tackers_message'] ) ) : __( "This quiz is expired!", $this->plugin_name );

// Show the Social buttons
$options['enable_social_buttons'] = isset($options['enable_social_buttons']) ? sanitize_text_field($options['enable_social_buttons']) : 'off';
$enable_social_buttons = (isset($options['enable_social_buttons']) && $options['enable_social_buttons'] == 'on') ? true : false;

// Enable Linkedin button
$options['quiz_enable_linkedin_share_button'] = isset($options['quiz_enable_linkedin_share_button']) ? sanitize_text_field($options['quiz_enable_linkedin_share_button']) : 'on';
$quiz_enable_linkedin_share_button = (isset($options['quiz_enable_linkedin_share_button']) && $options['quiz_enable_linkedin_share_button'] == 'on') ? true : false;

// Enable Facebook button
$options['quiz_enable_facebook_share_button'] = isset($options['quiz_enable_facebook_share_button']) ? sanitize_text_field($options['quiz_enable_facebook_share_button']) : 'on';
$quiz_enable_facebook_share_button = (isset($options['quiz_enable_facebook_share_button']) && $options['quiz_enable_facebook_share_button'] == 'on') ? true : false;

// Enable Twitter button
$options['quiz_enable_twitter_share_button'] = isset($options['quiz_enable_twitter_share_button']) ? sanitize_text_field($options['quiz_enable_twitter_share_button']) : 'on';
$quiz_enable_twitter_share_button = (isset($options['quiz_enable_twitter_share_button']) && $options['quiz_enable_twitter_share_button'] == 'on') ? true : false;

// Enable VKontakte button
$options['quiz_enable_vkontakte_share_button'] = isset($options['quiz_enable_vkontakte_share_button']) ? sanitize_text_field($options['quiz_enable_vkontakte_share_button']) : 'on';
$quiz_enable_vkontakte_share_button = (isset($options['quiz_enable_vkontakte_share_button']) && $options['quiz_enable_vkontakte_share_button'] == 'on') ? true : false;

if ( ! $quiz_enable_linkedin_share_button &&
        ! $quiz_enable_facebook_share_button &&
            ! $quiz_enable_vkontakte_share_button &&
                ! $quiz_enable_twitter_share_button ) {
    $quiz_enable_linkedin_share_button = true;
    $quiz_enable_facebook_share_button = true;
    $quiz_enable_twitter_share_button = true;
    $quiz_enable_vkontakte_share_button = true;
}

// Turn on extra security check
$options['turn_on_extra_security_check'] = isset($options['turn_on_extra_security_check']) ? sanitize_text_field($options['turn_on_extra_security_check']) : 'on';
$turn_on_extra_security_check = (isset($options['turn_on_extra_security_check']) && $options['turn_on_extra_security_check'] == 'on') ? true : false;

// Hide attempts limitation notice
$options['hide_limit_attempts_notice'] = isset($options['hide_limit_attempts_notice']) ? sanitize_text_field($options['hide_limit_attempts_notice']) : 'off';
$hide_limit_attempts_notice = (isset($options['hide_limit_attempts_notice']) && $options['hide_limit_attempts_notice'] == 'on') ? true : false;

// Enable top keywords
$options['enable_top_keywords'] = isset($options['enable_top_keywords']) ? sanitize_text_field($options['enable_top_keywords']) : 'off';
$enable_top_keywords = (isset($options['enable_top_keywords']) && $options['enable_top_keywords'] == 'on') ? true : false;

// Make responses anonymous
$options['quiz_make_responses_anonymous'] = isset($options['quiz_make_responses_anonymous']) ? sanitize_text_field($options['quiz_make_responses_anonymous']) : 'off';
$quiz_make_responses_anonymous = (isset($options['quiz_make_responses_anonymous']) && $options['quiz_make_responses_anonymous'] == 'on') ? true : false;

// Add all reviews link
$options['quiz_make_all_review_link'] = isset($options['quiz_make_all_review_link']) ? sanitize_text_field($options['quiz_make_all_review_link']) : 'off';
$quiz_make_all_review_link = (isset($options['quiz_make_all_review_link']) && $options['quiz_make_all_review_link'] == 'on') ? true : false;

// Custom CSS
$ays_quiz_custom_css = (isset($options['custom_css']) && $options['custom_css'] != '') ? esc_attr( $options['custom_css'] ) : '';

//Enable Bulk Coupon
$options['quiz_enable_coupon'] = isset($options['quiz_enable_coupon']) ? sanitize_text_field($options['quiz_enable_coupon']) : 'off';
$quiz_enable_coupon = (isset($options['quiz_enable_coupon']) && $options['quiz_enable_coupon'] == 'on') ? true : false;

//Active/Inactive coupons
$active_inactive_coupons = (isset($options['quiz_coupons_array']) && $options['quiz_coupons_array'] != '') ? $options['quiz_coupons_array'] : array();

if(!empty($active_inactive_coupons)){

    $quiz_active_coupons = (isset( $active_inactive_coupons['quiz_active_coupons']) && !empty( $active_inactive_coupons['quiz_active_coupons'])) ?  $active_inactive_coupons['quiz_active_coupons'] : array();

    $quiz_inactive_coupons = (isset( $active_inactive_coupons['quiz_inactive_coupons']) && !empty( $active_inactive_coupons['quiz_inactive_coupons'])) ?  $active_inactive_coupons['quiz_inactive_coupons'] : array();
}

// Message before timer
$quiz_message_before_timer = (isset($options['quiz_message_before_timer']) && $options['quiz_message_before_timer'] != '') ? esc_attr( sanitize_text_field( $options['quiz_message_before_timer'] ) ) : '';

// Password for passing quiz | Message
$quiz_password_message = ( isset( $options['quiz_password_message']) && $options['quiz_password_message'] != '' ) ? stripslashes( $options['quiz_password_message'] ) : '';

// Enable confirmation box for the See Result button
$options['enable_see_result_confirm_box'] = isset($options['enable_see_result_confirm_box']) ? sanitize_text_field($options['enable_see_result_confirm_box']) : 'off';
$enable_see_result_confirm_box = (isset($options['enable_see_result_confirm_box']) && $options['enable_see_result_confirm_box'] == 'on') ? true : false;

// Display form fields labels
$options['display_fields_labels'] = isset($options['display_fields_labels']) ? sanitize_text_field($options['display_fields_labels']) : 'off';
$display_fields_labels = (isset($options['display_fields_labels']) && $options['display_fields_labels'] == 'on') ? true : false;

// Enable toggle password visibility
$options['quiz_enable_password_visibility'] = isset($options['quiz_enable_password_visibility']) ? $options['quiz_enable_password_visibility'] : 'off';
$quiz_enable_password_visibility = (isset($options['quiz_enable_password_visibility']) && $options['quiz_enable_password_visibility'] == 'on') ? true : false;

// Question font size | On mobile
$question_mobile_font_size = (isset($options['question_mobile_font_size']) && sanitize_text_field($options['question_mobile_font_size']) != '' && absint( esc_attr($options['question_mobile_font_size']) ) > 0) ? absint( esc_attr($options['question_mobile_font_size']) ) : 16;

// Answer font size | On mobile
$answers_mobile_font_size = (isset($options['answers_mobile_font_size']) && sanitize_text_field($options['answers_mobile_font_size']) != '' && absint( sanitize_text_field($options['answers_mobile_font_size']) ) > 0) ? absint( sanitize_text_field($options['answers_mobile_font_size']) ) : 15;

// Heading for social buttons
$social_buttons_heading = (isset($options['social_buttons_heading']) && $options['social_buttons_heading'] != '') ? stripslashes( wpautop( $options['social_buttons_heading'] ) ) : "";

// Limit Attempts Count By User Role
$limit_attempts_count_by_user_role = (isset($options['limit_attempts_count_by_user_role']) && $options['limit_attempts_count_by_user_role'] != "") ?  absint(intval($options['limit_attempts_count_by_user_role'])) : '';

// Enable autostart
$options['enable_autostart'] = isset($options['enable_autostart']) ? $options['enable_autostart'] : 'off';
$enable_autostart = (isset($options['enable_autostart']) && $options['enable_autostart'] == 'on') ? true : false;

// Heading for social media links
$social_links_heading = (isset($options['social_links_heading']) && $options['social_links_heading'] != '') ? stripslashes( wpautop( $options['social_links_heading'] ) ) : "";

// Show question category description
$options['quiz_enable_question_category_description'] = isset($options['quiz_enable_question_category_description']) ? $options['quiz_enable_question_category_description'] : 'off';
$quiz_enable_question_category_description = (isset($options['quiz_enable_question_category_description']) && $options['quiz_enable_question_category_description'] == 'on') ? true : false;

// Answers margin option
$answers_margin = (isset($options['answers_margin']) && $options['answers_margin'] != '') ? esc_attr( stripslashes( $options['answers_margin'] ) ) : '12';

// Message before redirect timer
$quiz_message_before_redirect_timer = (isset($options['quiz_message_before_redirect_timer']) && $options['quiz_message_before_redirect_timer'] != '') ? stripslashes( esc_attr( $options['quiz_message_before_redirect_timer'] ) ) : '';

// Button font-size (px) | Mobile
$buttons_mobile_font_size = (isset($options['buttons_mobile_font_size']) && $options['buttons_mobile_font_size'] != '') ? absint( esc_attr( $options['buttons_mobile_font_size'] ) ) : 18;

// Change current quiz creation date
$change_creation_date = (isset($quiz['create_date']) && $quiz['create_date'] != '') ? $quiz['create_date'] : current_time( 'mysql' );

// Answer box Shadow X offset
$quiz_answer_box_shadow_x_offset = (isset($options['quiz_answer_box_shadow_x_offset']) && ( $options['quiz_answer_box_shadow_x_offset'] ) != '' && ( $options['quiz_answer_box_shadow_x_offset'] ) != 0) ? esc_attr( intval( $options['quiz_answer_box_shadow_x_offset'] ) ) : 0;

// Answer box Shadow Y offset
$quiz_answer_box_shadow_y_offset = (isset($options['quiz_answer_box_shadow_y_offset']) && ( $options['quiz_answer_box_shadow_y_offset'] ) != '' && ( $options['quiz_answer_box_shadow_y_offset'] ) != 0) ? esc_attr( intval( $options['quiz_answer_box_shadow_y_offset'] ) ) : 0;

// Answer box Shadow Z offset
$quiz_answer_box_shadow_z_offset = (isset($options['quiz_answer_box_shadow_z_offset']) && ( $options['quiz_answer_box_shadow_z_offset'] ) != '' && ( $options['quiz_answer_box_shadow_z_offset'] ) != 0) ? esc_attr( intval( $options['quiz_answer_box_shadow_z_offset'] ) ) : 10;

// Change the author of the current quiz
$change_quiz_create_author = (isset($quiz['author_id']) && $quiz['author_id'] != '') ? absint( sanitize_text_field( $quiz['author_id'] ) ) : $user_id;

if( $change_quiz_create_author  && $change_quiz_create_author > 0 ){
    global $wpdb;
    $users_table = esc_sql( $db_prefix . 'users' );

    $sql_users = "SELECT ID,display_name FROM {$users_table} WHERE ID = {$change_quiz_create_author}";

    $ays_quiz_create_author_data = $wpdb->get_row($sql_users, "ARRAY_A");

    if( is_null( $ays_quiz_create_author_data ) || empty($ays_quiz_create_author_data) ){
        $change_quiz_create_author = $user_id;
        $ays_quiz_create_author_data = array(
            "ID" => $user_id,
            "display_name" => $user->data->display_name,
        );
    }
} else {
    $change_quiz_create_author = $user_id;
    $ays_quiz_create_author_data = array(
        "ID" => $user_id,
        "display_name" => $user->data->display_name,
    );
}

$ays_users_to_export_search = array();

if( isset( $options['ays_users_to_export_search'] ) && !empty( $options['ays_users_to_export_search'] ) ){

    $users_table = esc_sql( $db_prefix . 'users' );

    $quiz_user_ids = implode( ",", $options['ays_users_to_export_search'] );

    $sql_users = "SELECT ID,display_name FROM {$users_table} WHERE ID IN (". $quiz_user_ids .")";

    $ays_users_to_export_search = $wpdb->get_results($sql_users, "ARRAY_A");
}

// Quiz title text shadow
$options['quiz_enable_title_text_shadow'] = isset($options['quiz_enable_title_text_shadow']) ? esc_attr($options['quiz_enable_title_text_shadow']) : 'off';
$quiz_enable_title_text_shadow = (isset($options['quiz_enable_title_text_shadow']) && $options['quiz_enable_title_text_shadow'] == 'on') ? true : false;

// Quiz title text shadow color
$quiz_title_text_shadow_color = (isset($options['quiz_title_text_shadow_color']) && $options['quiz_title_text_shadow_color'] != '') ? esc_attr($options['quiz_title_text_shadow_color']) : '#333';

// Font size for the right answer
$right_answers_font_size = (isset($options['right_answers_font_size']) && $options['right_answers_font_size'] != '') ? absint(esc_attr($options['right_answers_font_size'])) : '16';

// Font size for the wrong answer
$wrong_answers_font_size = (isset($options['wrong_answers_font_size']) && $options['wrong_answers_font_size'] != '') ? absint(esc_attr($options['wrong_answers_font_size'])) : '16';

// Font size for the wrong answer | Mobile
$wrong_answers_mobile_font_size = (isset($options['wrong_answers_mobile_font_size']) && $options['wrong_answers_mobile_font_size'] != '') ? absint(esc_attr($options['wrong_answers_mobile_font_size'])) : $wrong_answers_font_size;

// Font size for the question explanation
$quest_explanation_font_size = (isset($options['quest_explanation_font_size']) && $options['quest_explanation_font_size'] != '') ? absint(esc_attr($options['quest_explanation_font_size'])) : '16';

// Font size for the question explanation | Mobile
$quest_explanation_mobile_font_size = (isset($options['quest_explanation_mobile_font_size']) && $options['quest_explanation_mobile_font_size'] != '') ? absint(esc_attr($options['quest_explanation_mobile_font_size'])) : $quest_explanation_font_size;

// Waiting time
$options['quiz_waiting_time'] = isset($options['quiz_waiting_time']) ? esc_attr($options['quiz_waiting_time']) : 'off';
$quiz_waiting_time = (isset($options['quiz_waiting_time']) && $options['quiz_waiting_time'] == 'on') ? true : false;

// Quiz Title Text Shadow X offset
$quiz_title_text_shadow_x_offset = (isset($options['quiz_title_text_shadow_x_offset']) && ( $options['quiz_title_text_shadow_x_offset'] ) != '' && ( $options['quiz_title_text_shadow_x_offset'] ) != 0) ? esc_attr( intval( $options['quiz_title_text_shadow_x_offset'] ) ) : 2;

// Quiz Title Text Shadow Y offset
$quiz_title_text_shadow_y_offset = (isset($options['quiz_title_text_shadow_y_offset']) && ( $options['quiz_title_text_shadow_y_offset'] ) != '' && ( $options['quiz_title_text_shadow_y_offset'] ) != 0) ? esc_attr( intval( $options['quiz_title_text_shadow_y_offset'] ) ) : 2;

// Quiz Title Text Shadow Z offset
$quiz_title_text_shadow_z_offset = (isset($options['quiz_title_text_shadow_z_offset']) && ( $options['quiz_title_text_shadow_z_offset'] ) != '' && ( $options['quiz_title_text_shadow_z_offset'] ) != 0) ? esc_attr( intval( $options['quiz_title_text_shadow_z_offset'] ) ) : 2;

// Show only wrong answers
$options['quiz_show_only_wrong_answers'] = isset($options['quiz_show_only_wrong_answers']) ? sanitize_text_field($options['quiz_show_only_wrong_answers']) : 'off';
$quiz_show_only_wrong_answers = (isset($options['quiz_show_only_wrong_answers']) && $options['quiz_show_only_wrong_answers'] == 'on') ? true : false;

// Quiz title font size
$quiz_title_font_size = (isset($options['quiz_title_font_size']) && ( $options['quiz_title_font_size'] ) != '' && ( $options['quiz_title_font_size'] ) != 0) ? esc_attr( absint( $options['quiz_title_font_size'] ) ) : 28;

// Quiz title font size | On mobile
$quiz_title_mobile_font_size = (isset($options['quiz_title_mobile_font_size']) && sanitize_text_field($options['quiz_title_mobile_font_size']) != '') ? esc_attr( absint($options['quiz_title_mobile_font_size']) ) : 20;

// Quiz password width
$quiz_password_width = (isset($options['quiz_password_width']) && ( $options['quiz_password_width'] ) != '' && ( $options['quiz_password_width'] ) != 0) ? esc_attr( absint( $options['quiz_password_width'] ) ) : "";

// Enable quiz assessment | Placeholder text
$quiz_review_placeholder_text = (isset($options['quiz_review_placeholder_text']) && $options['quiz_review_placeholder_text'] != '') ? stripslashes( esc_attr( $options['quiz_review_placeholder_text'] ) ) : "";

// Make review required
$options['quiz_make_review_required'] = isset($options['quiz_make_review_required']) ? sanitize_text_field($options['quiz_make_review_required']) : 'off';
$quiz_make_review_required = (isset($options['quiz_make_review_required']) && $options['quiz_make_review_required'] == 'on') ? true : false;

// Enable the Show/Hide toggle
$options['quiz_enable_results_toggle'] = isset($options['quiz_enable_results_toggle']) ? sanitize_text_field($options['quiz_enable_results_toggle']) : 'off';
$quiz_enable_results_toggle = (isset($options['quiz_enable_results_toggle']) && $options['quiz_enable_results_toggle'] == 'on') ? true : false;

// Thank you message | Review
$quiz_review_thank_you_message = (isset($options['quiz_review_thank_you_message']) && $options['quiz_review_thank_you_message'] != '') ? stripslashes( wpautop( $options['quiz_review_thank_you_message'] ) ) : "";

// Enable Comment Field
$options['quiz_review_enable_comment_field'] = isset($options['quiz_review_enable_comment_field']) ? sanitize_text_field($options['quiz_review_enable_comment_field']) : 'on';
$quiz_review_enable_comment_field = (isset($options['quiz_review_enable_comment_field']) && $options['quiz_review_enable_comment_field'] == 'on') ? true : false;

//Enable keyboard navigation
$options['quiz_enable_keyboard_navigation'] = isset($options['quiz_enable_keyboard_navigation']) ? $options['quiz_enable_keyboard_navigation'] : 'off';
$quiz_enable_keyboard_navigation = (isset($options['quiz_enable_keyboard_navigation']) && $options['quiz_enable_keyboard_navigation'] == 'on') ? true : false;
if( $action == 'add' ){
    $quiz_enable_keyboard_navigation = true;
}

// Question Image Zoom
$options['quiz_enable_question_image_zoom'] = isset($options['quiz_enable_question_image_zoom']) ? esc_attr($options['quiz_enable_question_image_zoom']) : 'off';
$quiz_enable_question_image_zoom = (isset($options['quiz_enable_question_image_zoom']) && $options['quiz_enable_question_image_zoom'] == 'on') ? true : false;

// Font size for the right answer | Mobile
$right_answers_mobile_font_size = (isset($options['right_answers_mobile_font_size']) && $options['right_answers_mobile_font_size'] != '') ? absint(esc_attr($options['right_answers_mobile_font_size'])) : $right_answers_font_size;

// Display Messages before the buttons
$options['quiz_display_messages_before_buttons'] = isset($options['quiz_display_messages_before_buttons']) ? esc_attr($options['quiz_display_messages_before_buttons']) : 'off';
$quiz_display_messages_before_buttons = (isset($options['quiz_display_messages_before_buttons']) && $options['quiz_display_messages_before_buttons'] == 'on') ? true : false;

// Question per page type
$question_count_per_page_type = (isset($options['question_count_per_page_type']) && $options['question_count_per_page_type'] != '') ? sanitize_text_field($options['question_count_per_page_type']) : 'general';

$question_count_per_page_custom_order = (isset($options['question_count_per_page_custom_order']) && $options['question_count_per_page_custom_order'] != "" ) ? sanitize_text_field($options['question_count_per_page_custom_order']) : '';

if( !empty( $question_count_per_page_custom_order ) ){
    $question_count_per_page_custom_order_arr = explode(',', $question_count_per_page_custom_order);

    if ( !empty( $question_count_per_page_custom_order_arr ) ) {
        $question_count_per_page_custom_order_arr_new = array();
        foreach ($question_count_per_page_custom_order_arr as $per_page_key => $per_page_value) {
            if( is_numeric( $per_page_value ) && $per_page_value != "" && $per_page_value != 0 ){
                $question_count_per_page_custom_order_arr_new[] = absint($per_page_value);
            }
        }
        $question_count_per_page_custom_order = implode( "," , $question_count_per_page_custom_order_arr_new);
    }
}

// Timer type
$quiz_timer_type = (isset($options['quiz_timer_type']) && $options['quiz_timer_type'] != '') ? sanitize_text_field( $options['quiz_timer_type'] ) : 'quiz_timer';

// Display Messages before the buttons
$options['ays_allow_exporting_quizzes'] = isset($options['ays_allow_exporting_quizzes']) ? esc_attr($options['ays_allow_exporting_quizzes']) : 'off';
$ays_allow_exporting_quizzes = (isset($options['ays_allow_exporting_quizzes']) && $options['ays_allow_exporting_quizzes'] == 'on') ? true : false;

// Quiz Pass Score type
$quiz_pass_score_type = (isset($options['quiz_pass_score_type']) && $options['quiz_pass_score_type'] != '') ? sanitize_text_field( $options['quiz_pass_score_type'] ) : 'percentage';

// Certificate Quiz Pass Score type
$quiz_certificate_pass_score_type = (isset($options['quiz_certificate_pass_score_type']) && $options['quiz_certificate_pass_score_type'] != '') ? sanitize_text_field( $options['quiz_certificate_pass_score_type'] ) : 'percentage';

// Equal keywords text
$quiz_equal_keywords_text = (isset($options['quiz_equal_keywords_text']) && $options['quiz_equal_keywords_text'] != '') ? stripslashes( $options['quiz_equal_keywords_text'] ) : "";

//Enable navigation bar marked questions
$options['enable_navigation_bar_marked_questions'] = isset($options['enable_navigation_bar_marked_questions']) ? $options['enable_navigation_bar_marked_questions'] : 'off';
$enable_navigation_bar_marked_questions = (isset($options['enable_navigation_bar_marked_questions']) && $options['enable_navigation_bar_marked_questions'] == 'on') ? true : false;

// enable question reporting
$options['enable_questions_reporting'] = isset($options['enable_questions_reporting']) ? $options['enable_questions_reporting'] : 'off';
$enable_question_reporting = (isset($options['enable_questions_reporting']) && $options['enable_questions_reporting'] == "on") ? true : false;

// Show question category description
$options['quiz_enable_questions_reporting_mail'] = isset($options['quiz_enable_questions_reporting_mail']) ? $options['quiz_enable_questions_reporting_mail'] : 'off';
$quiz_enable_question_reporting_mail = (isset($options['quiz_enable_questions_reporting_mail']) && $options['quiz_enable_questions_reporting_mail'] == 'on') ? true : false;

// Enable users' anonymous assessment
$options['quiz_enable_user_cհoosing_anonymous_assessment'] = isset($options['quiz_enable_user_cհoosing_anonymous_assessment']) ? sanitize_text_field($options['quiz_enable_user_cհoosing_anonymous_assessment']) : 'off';
$quiz_enable_user_cհoosing_anonymous_assessment = (isset($options['quiz_enable_user_cհoosing_anonymous_assessment']) && $options['quiz_enable_user_cհoosing_anonymous_assessment'] == 'on') ? true : false;

// Font size for the Note text | PC
$note_text_font_size = (isset($options['note_text_font_size']) && $options['note_text_font_size'] != '') ? absint(esc_attr($options['note_text_font_size'])) : '14';

// Font size for the Note text | Mobile
$note_text_mobile_font_size = (isset($options['note_text_mobile_font_size']) && $options['note_text_mobile_font_size'] != '') ? absint(esc_attr($options['note_text_mobile_font_size'])) : $note_text_font_size;

// Enable questions numbering by category
$options['quiz_questions_numbering_by_category'] = isset($options['quiz_questions_numbering_by_category']) ? sanitize_text_field($options['quiz_questions_numbering_by_category']) : 'off';
$quiz_questions_numbering_by_category = (isset($options['quiz_questions_numbering_by_category']) && $options['quiz_questions_numbering_by_category'] == 'on') ? true : false;

// Questions text to speech enable
$options[ 'quiz_question_text_to_speech' ] = isset($options[ 'quiz_question_text_to_speech' ]) ? $options[ 'quiz_question_text_to_speech' ] : 'off';
$quiz_question_text_to_speech = (isset($options[ 'quiz_question_text_to_speech' ]) && $options[ 'quiz_question_text_to_speech' ] == 'on') ? true : false;

// Questions text to speech voice
$quiz_question_text_to_speech_voice = (isset($options[ 'quiz_question_text_to_speech_voice' ]) && $options[ 'quiz_question_text_to_speech_voice' ] != '') ? sanitize_text_field($options[ 'quiz_question_text_to_speech_voice' ]) : 'Microsoft David - English (United States)';

// Disable input focusing
$options[ 'quiz_disable_input_focusing' ] = isset($options[ 'quiz_disable_input_focusing' ]) ? $options[ 'quiz_disable_input_focusing' ] : 'off';
$quiz_disable_input_focusing = (isset($options[ 'quiz_disable_input_focusing' ]) && $options[ 'quiz_disable_input_focusing' ] == 'on') ? true : false;

// Password Import type
$quiz_password_import_type = (isset($options['quiz_password_import_type']) && ( $options['quiz_password_import_type'] ) != '' ) ? esc_attr( $options['quiz_password_import_type'] ) : "default";

// Show all conditions results
$options[ 'quiz_condition_show_all_results' ] = isset($options[ 'quiz_condition_show_all_results' ]) ? $options[ 'quiz_condition_show_all_results' ] : 'off';
$quiz_condition_show_all_results = (isset($options[ 'quiz_condition_show_all_results' ]) && $options[ 'quiz_condition_show_all_results' ] == 'on') ? true : false;

// Condition calculation type
$quiz_condition_calculation_type = (isset($options['quiz_condition_calculation_type']) && $options['quiz_condition_calculation_type'] != '') ? sanitize_text_field( $options['quiz_condition_calculation_type'] ) : 'default';

// Enable custom texts for buttons
$options['quiz_enable_custom_texts_for_buttons'] = isset($options['quiz_enable_custom_texts_for_buttons']) ? sanitize_text_field($options['quiz_enable_custom_texts_for_buttons']) : 'off';
$quiz_enable_custom_texts_for_buttons = (isset($options['quiz_enable_custom_texts_for_buttons']) && $options['quiz_enable_custom_texts_for_buttons'] == 'on') ? true : false;

$quiz_custom_texts_start_button = (isset($options['quiz_custom_texts_start_button']) && $options['quiz_custom_texts_start_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_start_button'] ) ) : $start_button;

$quiz_custom_texts_next_button = (isset($options['quiz_custom_texts_next_button']) && $options['quiz_custom_texts_next_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_next_button'] ) ) : $next_button;

$quiz_custom_texts_prev_button = (isset($options['quiz_custom_texts_prev_button']) && $options['quiz_custom_texts_prev_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_prev_button'] ) ) : $previous_button;

$quiz_custom_texts_clear_button = (isset($options['quiz_custom_texts_clear_button']) && $options['quiz_custom_texts_clear_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_clear_button'] ) ) : $clear_button;

$quiz_custom_texts_finish_button = (isset($options['quiz_custom_texts_finish_button']) && $options['quiz_custom_texts_finish_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_finish_button'] ) ) : $finish_button;

$quiz_custom_texts_see_results_button = (isset($options['quiz_custom_texts_see_results_button']) && $options['quiz_custom_texts_see_results_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_see_results_button'] ) ) : $see_result_button;

$quiz_custom_texts_restart_quiz_button = (isset($options['quiz_custom_texts_restart_quiz_button']) && $options['quiz_custom_texts_restart_quiz_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_restart_quiz_button'] ) ) : $restart_quiz_button;

$quiz_custom_texts_send_feedback_button = (isset($options['quiz_custom_texts_send_feedback_button']) && $options['quiz_custom_texts_send_feedback_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_send_feedback_button'] ) ) : $send_feedback_button;

$quiz_custom_texts_load_more_button = (isset($options['quiz_custom_texts_load_more_button']) && $options['quiz_custom_texts_load_more_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_load_more_button'] ) ) : $load_more_button;

$quiz_custom_texts_exit_button = (isset($options['quiz_custom_texts_exit_button']) && $options['quiz_custom_texts_exit_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_exit_button'] ) ) : $gen_exit_button;

$quiz_custom_texts_check_button = (isset($options['quiz_custom_texts_check_button']) && $options['quiz_custom_texts_check_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_check_button'] ) ) : $gen_check_button;

$quiz_custom_texts_login_button = (isset($options['quiz_custom_texts_login_button']) && $options['quiz_custom_texts_login_button'] != '') ? stripslashes( esc_attr( $options['quiz_custom_texts_login_button'] ) ) : $gen_login_button;

// Show quiz category description
$options['quiz_enable_quiz_category_description'] = isset($options['quiz_enable_quiz_category_description']) ? $options['quiz_enable_quiz_category_description'] : 'off';
$quiz_enable_quiz_category_description = (isset($options['quiz_enable_quiz_category_description']) && $options['quiz_enable_quiz_category_description'] == 'on') ? true : false;

// Note text transform size
$quiz_admin_note_text_transform = (isset($options[ 'quiz_admin_note_text_transform' ]) && $options[ 'quiz_admin_note_text_transform' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_admin_note_text_transform' ] ) ) : 'none';

// Navigation bar style
$quiz_navigation_bar_type = (isset($options['quiz_navigation_bar_type']) && sanitize_text_field( $options['quiz_navigation_bar_type'] ) != '') ? sanitize_text_field( $options['quiz_navigation_bar_type'] ) : 'default';

// Show question tags
$options['quiz_show_question_tags'] = isset($options['quiz_show_question_tags']) ? $options['quiz_show_question_tags'] : 'off';
$quiz_show_question_tags = (isset($options['quiz_show_question_tags']) && $options['quiz_show_question_tags'] == "on") ? true : false;

// Show/hide results based on pass score
$options['quiz_show_results_based_pass_score'] = isset($options['quiz_show_results_based_pass_score']) ? sanitize_text_field($options['quiz_show_results_based_pass_score']) : 'off';
$quiz_show_results_based_pass_score = (isset($options['quiz_show_results_based_pass_score']) && $options['quiz_show_results_based_pass_score'] == 'on') ? true : false;

// Show Interval Messages for equal keywords
$options['quiz_show_interval_messages_for_equal_keywords'] = isset($options['quiz_show_interval_messages_for_equal_keywords']) ? sanitize_text_field($options['quiz_show_interval_messages_for_equal_keywords']) : 'off';
$quiz_show_interval_messages_for_equal_keywords = (isset($options['quiz_show_interval_messages_for_equal_keywords']) && $options['quiz_show_interval_messages_for_equal_keywords'] == 'on') ? true : false;

// Hide the Banner Question type
$options['quiz_hide_banner_questions_on_result_page'] = isset($options['quiz_hide_banner_questions_on_result_page']) ? sanitize_text_field($options['quiz_hide_banner_questions_on_result_page']) : 'off';
$quiz_hide_banner_questions_on_result_page = (isset($options['quiz_hide_banner_questions_on_result_page']) && $options['quiz_hide_banner_questions_on_result_page'] == 'on') ? true : false;

// Answer view grid count
$quiz_grid_view_count = (isset($options[ 'quiz_grid_view_count' ]) && $options[ 'quiz_grid_view_count' ] != '') ? stripslashes( esc_attr( $options[ 'quiz_grid_view_count' ] ) ) : '2';

// Answer view grid only for image
$options['quiz_grid_image_view'] = isset($options['quiz_grid_image_view']) ? sanitize_text_field($options['quiz_grid_image_view']) : 'off';
$quiz_grid_image_view = (isset($options[ 'quiz_grid_image_view' ]) && $options[ 'quiz_grid_image_view' ] == 'on') ? true : false;

// Send results without images user
$options['quiz_send_results_user_without_img'] = isset($options['quiz_send_results_user_without_img']) ? sanitize_text_field($options['quiz_send_results_user_without_img']) : 'off';
$quiz_send_results_user_without_img = (isset($options[ 'quiz_send_results_user_without_img' ]) && $options[ 'quiz_send_results_user_without_img' ] == 'on') ? true : false;

// Send results without images admin
$options['quiz_send_results_admin_without_img'] = isset($options['quiz_send_results_admin_without_img']) ? sanitize_text_field($options['quiz_send_results_admin_without_img']) : 'off';
$quiz_send_results_admin_without_img = (isset($options[ 'quiz_send_results_admin_without_img' ]) && $options[ 'quiz_send_results_admin_without_img' ] == 'on') ? true : false;

// Question explanation transform size
$quiz_quest_explanation_text_transform = (isset($options[ 'quiz_quest_explanation_text_transform' ]) && $options[ 'quiz_quest_explanation_text_transform' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_quest_explanation_text_transform' ] ) ) : 'none';

// Right answer transform size
$quiz_right_answer_text_transform = (isset($options[ 'quiz_right_answer_text_transform' ]) && $options[ 'quiz_right_answer_text_transform' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_right_answer_text_transform' ] ) ) : 'none';

// Wrong answer transform size
$quiz_wrong_answer_text_transform = (isset($options[ 'quiz_wrong_answer_text_transform' ]) && $options[ 'quiz_wrong_answer_text_transform' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_wrong_answer_text_transform' ] ) ) : 'none';

// Note text decoration
$quiz_admin_note_text_decoration = (isset($options[ 'quiz_admin_note_text_decoration' ]) && $options[ 'quiz_admin_note_text_decoration' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_admin_note_text_decoration' ] ) ) : 'none';

// Question Explanation text decoration
$quiz_quest_explanation_text_decoration = (isset($options[ 'quiz_quest_explanation_text_decoration' ]) && $options[ 'quiz_quest_explanation_text_decoration' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_quest_explanation_text_decoration' ] ) ) : 'none';

// Right answer text decoration
$quiz_right_answers_text_decoration = (isset($options[ 'quiz_right_answers_text_decoration' ]) && $options[ 'quiz_right_answers_text_decoration' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_right_answers_text_decoration' ] ) ) : 'none';

// Wrong answer text decoration
$quiz_wrong_answers_text_decoration = (isset($options[ 'quiz_wrong_answers_text_decoration' ]) && $options[ 'quiz_wrong_answers_text_decoration' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_wrong_answers_text_decoration' ] ) ) : 'none';

// Note letter spacing | Admin note
$quiz_admin_note_letter_spacing = (isset($options[ 'quiz_admin_note_letter_spacing' ]) && $options[ 'quiz_admin_note_letter_spacing' ] != '') ? stripslashes ( absint( $options[ 'quiz_admin_note_letter_spacing' ] ) ) : 0;

// Hide background image during the quiz
$options['quiz_bg_img_during_the_quiz'] = isset($options['quiz_bg_img_during_the_quiz']) ? $options['quiz_bg_img_during_the_quiz'] : 'off';
$quiz_bg_img_during_the_quiz = (isset($options['quiz_bg_img_during_the_quiz']) && $options['quiz_bg_img_during_the_quiz'] == 'on') ? true : false;

// Letter spacing | Question Explanation
$quiz_quest_explanation_letter_spacing = (isset($options[ 'quiz_quest_explanation_letter_spacing' ]) && $options[ 'quiz_quest_explanation_letter_spacing' ] != '') ? stripslashes ( absint( $options[ 'quiz_quest_explanation_letter_spacing' ] ) ) : 0;

// Letter spacing | Right answer
$quiz_right_answers_letter_spacing = (isset($options[ 'quiz_right_answers_letter_spacing' ]) && $options[ 'quiz_right_answers_letter_spacing' ] != '') ? stripslashes ( absint( $options[ 'quiz_right_answers_letter_spacing' ] ) ) : 0;

// Letter spacing | Wrong answer
$quiz_wrong_answers_letter_spacing = (isset($options[ 'quiz_wrong_answers_letter_spacing' ]) && $options[ 'quiz_wrong_answers_letter_spacing' ] != '') ? stripslashes ( absint( $options[ 'quiz_wrong_answers_letter_spacing' ] ) ) : 0;

// Admin Note font weight
$quiz_admin_note_font_weight = (isset($options[ 'quiz_admin_note_font_weight' ]) && $options[ 'quiz_admin_note_font_weight' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_admin_note_font_weight' ] ) ) : 'normal';

// Question Explanation font weight
$quiz_quest_explanation_font_weight = (isset($options[ 'quiz_quest_explanation_font_weight' ]) && $options[ 'quiz_quest_explanation_font_weight' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_quest_explanation_font_weight' ] ) ) : 'normal';

// Right answer font weight
$quiz_right_answers_font_weight = (isset($options[ 'quiz_right_answers_font_weight' ]) && $options[ 'quiz_right_answers_font_weight' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_right_answers_font_weight' ] ) ) : 'normal';

// Wrong answer font weight
$quiz_wrong_answers_font_weight = (isset($options[ 'quiz_wrong_answers_font_weight' ]) && $options[ 'quiz_wrong_answers_font_weight' ] != '') ? stripslashes ( esc_attr( $options[ 'quiz_wrong_answers_font_weight' ] ) ) : 'normal';

// Quiz Section collapse flag
// $options['quiz_section_collapse_flag'] = isset($options['quiz_section_collapse_flag']) ? $options['quiz_section_collapse_flag'] : 'off';
// $quiz_section_collapse_flag_input = (isset($options['quiz_section_collapse_flag']) && $options['quiz_section_collapse_flag'] == 'on') ? 'on' : 'off';
// $quiz_section_collapse_flag = (isset($options['quiz_section_collapse_flag']) && $options['quiz_section_collapse_flag'] == 'on') ? 'true' : 'false';

// Quiz content max-width
$quiz_content_max_width = ( isset($options['quiz_content_max_width']) && $options['quiz_content_max_width'] != "" && intval($options['quiz_content_max_width']) > 0 ) ? intval(esc_attr($options['quiz_content_max_width'])) : 90;

// Quiz content mobile max-width
$quiz_content_mobile_max_width = ( isset($options['quiz_content_mobile_max_width']) && $options['quiz_content_mobile_max_width'] != "" && intval($options['quiz_content_mobile_max_width']) > 0 ) ? intval(esc_attr($options['quiz_content_mobile_max_width'])) : 90;

// Enable default Hide toggle
$options['quiz_enable_default_hide_results_toggle'] = isset($options['quiz_enable_default_hide_results_toggle']) ? sanitize_text_field($options['quiz_enable_default_hide_results_toggle']) : 'off';
$quiz_enable_default_hide_results_toggle = (isset($options['quiz_enable_default_hide_results_toggle']) && $options['quiz_enable_default_hide_results_toggle'] == 'on') ? true : false;

// Enable download result page PDF after quiz pass
$options['enable_result_page_pdf_download'] = isset($options['enable_result_page_pdf_download']) ? sanitize_text_field($options['enable_result_page_pdf_download']) : 'off';
$enable_result_page_pdf_download = (isset($options['enable_result_page_pdf_download']) && $options['enable_result_page_pdf_download'] == 'on') ? true : false;

// User right answer Message
$options['quiz_right_answer_message_user_mail'] = isset($options['quiz_right_answer_message_user_mail']) ? sanitize_text_field($options['quiz_right_answer_message_user_mail']) : 'off';
$quiz_right_answer_message_user_mail = (isset($options['quiz_right_answer_message_user_mail']) && $options['quiz_right_answer_message_user_mail'] == 'on') ? true : false;

// User wrong answer Message
$options['quiz_wrong_answer_message_user_mail'] = isset($options['quiz_wrong_answer_message_user_mail']) ? sanitize_text_field($options['quiz_wrong_answer_message_user_mail']) : 'off';
$quiz_wrong_answer_message_user_mail = (isset($options['quiz_wrong_answer_message_user_mail']) && $options['quiz_wrong_answer_message_user_mail'] == 'on') ? true : false;

// Show Restart button on quiz fail
$options['quiz_show_restart_button_on_quiz_fail'] = isset($options['quiz_show_restart_button_on_quiz_fail']) ? sanitize_text_field($options['quiz_show_restart_button_on_quiz_fail']) : 'off';
$quiz_show_restart_button_on_quiz_fail = (isset($options['quiz_show_restart_button_on_quiz_fail']) && $options['quiz_show_restart_button_on_quiz_fail'] == 'on') ? true : false;

// Question Image Height On mobile
$question_image_height_mobile = ( isset($options['question_image_height_mobile']) && $options['question_image_height_mobile'] != "" && intval($options['question_image_height_mobile']) > 0 ) ? intval(esc_attr($options['question_image_height_mobile'])) : '';

// Answer view grid count mobile
$quiz_grid_view_count_mobile = (isset($options[ 'quiz_grid_view_count_mobile' ]) && $options[ 'quiz_grid_view_count_mobile' ] != '') ? intval( stripslashes( $options[ 'quiz_grid_view_count_mobile' ] ) ) : 2;

// Answer view grid only for image mobile
$options['quiz_grid_image_view_mobile'] = isset($options['quiz_grid_image_view_mobile']) ? sanitize_text_field($options['quiz_grid_image_view_mobile']) : 'off';
$quiz_grid_image_view_mobile = (isset($options[ 'quiz_grid_image_view_mobile' ]) && $options[ 'quiz_grid_image_view_mobile' ] == 'on') ? true : false;

// Answer view
$answers_view = (isset($options['answers_view']) && $options['answers_view'] != '') ? sanitize_text_field( stripslashes( $options[ 'answers_view' ] ) ) : 'list';

// Answer view mobile
$answers_view_mobile = (isset($options['answers_view_mobile']) && $options['answers_view_mobile'] != '') ? sanitize_text_field( stripslashes( $options[ 'answers_view_mobile' ] ) ) : 'list';

// Points for each question
$quiz_enable_results_page_points_for_each_question = (isset($options['quiz_enable_results_page_points_for_each_question']) && $options['quiz_enable_results_page_points_for_each_question'] != '') ? sanitize_text_field($options['quiz_enable_results_page_points_for_each_question']) : 'hide';

// Timer Warning text color
$quiz_timer_warning_text_color = (isset($options['quiz_timer_warning_text_color']) && $options['quiz_timer_warning_text_color'] != '') ? stripslashes ( esc_attr( $options[ 'quiz_timer_warning_text_color' ] ) ) : '#ff0000';

// Enable default Hide toggle
$options['quiz_enable_default_hide_results_toggle'] = isset($options['quiz_enable_default_hide_results_toggle']) ? sanitize_text_field($options['quiz_enable_default_hide_results_toggle']) : 'off';
$quiz_enable_default_hide_results_toggle = (isset($options['quiz_enable_default_hide_results_toggle']) && $options['quiz_enable_default_hide_results_toggle'] == 'on') ? true : false;

// Show Restart button on quiz fail
$options['quiz_show_restart_button_on_quiz_fail'] = isset($options['quiz_show_restart_button_on_quiz_fail']) ? sanitize_text_field($options['quiz_show_restart_button_on_quiz_fail']) : 'off';
$quiz_show_restart_button_on_quiz_fail = (isset($options['quiz_show_restart_button_on_quiz_fail']) && $options['quiz_show_restart_button_on_quiz_fail'] == 'on') ? true : false;

// Disable numbering for Info Banner type
$options['quiz_disable_question_numbering_for_custom_type'] = isset($options['quiz_disable_question_numbering_for_custom_type']) ? sanitize_text_field($options['quiz_disable_question_numbering_for_custom_type']) : 'off';
$quiz_disable_question_numbering_for_custom_type = (isset($options['quiz_disable_question_numbering_for_custom_type']) && $options['quiz_disable_question_numbering_for_custom_type'] == 'on') ? true : false;


// Enable Info Icon for Info Banner Questions
$options['quiz_enable_navigation_bar_custom_question_icon'] = isset($options['quiz_enable_navigation_bar_custom_question_icon']) ? sanitize_text_field($options['quiz_enable_navigation_bar_custom_question_icon']) : 'off';
$quiz_enable_navigation_bar_custom_question_icon = (isset($options['quiz_enable_navigation_bar_custom_question_icon']) && $options['quiz_enable_navigation_bar_custom_question_icon'] == 'on') ? true : false;