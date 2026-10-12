<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap" id="ays-quiz-cards-main-block">
    <div class="ays-quiz-heading-box">
        <div class="ays-quiz-wordpress-user-manual-box">
            <a href="https://quiz-plugin.com/docs/" target="_blank">
                <i class="ays_fa ays_fa_file_text" ></i> 
                <span style="margin-left: 3px;text-decoration: underline;"><?php echo __("View Documentation", "quiz-maker"); ?></span>
            </a>
        </div>
    </div>
    <h1 id="ays-quiz-intro-title"><?php echo __('Please feel free to use our other awesome plugins!', $this->plugin_name); ?></h1>
    <?php $this->output_about_addons(); ?>
    <div class="ays-quiz-see-all">
        <a href="https://ays-pro.com/wordpress" target="_blank" class="ays-quiz-all-btn"><?php echo __('See All Plugins', $this->plugin_name); ?></a>
    </div>

    <!-- <p class="text-center coming-soon">And more and more is <span>Coming Soon</span></p> -->
</div>