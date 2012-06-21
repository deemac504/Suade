<div id="Cases-widget" class="col-right">
 
    <ul>
        <!--Open Top Widget UL-->
        <?php if ( is_active_sidebar( 'case-studies-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'case-studies-sidebar' ); ?>
        <?php else : ?>
        <li class="cases-widget" id="Pages">
            <div class="rounded">
                <h3 class="widget-title">Pages</h3>
                <ul>
                    <?php wp_list_pages('title_li='); ?>
                </ul>
            </div>
        </li>
        <?php endif; ?>
    </ul>
 
</div>