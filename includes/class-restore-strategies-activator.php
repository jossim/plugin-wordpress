<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.restorestrategies.org/
 * @since      1.0.0
 *
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Restore_Strategies
 * @subpackage Restore_Strategies/includes
 * @author     Restore Strategies <info@restorestrategies.org>
 */
class Restore_Strategies_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

        $opp_example_copy = 'Display a single opportunity using the <b>opportunity shortcode</b>. For this, you <em>need to have a valid opportunity id</em>. You can find the id of an opportunity by searching using the [[restore-strategies-search-box]] shortcode & clicking on the opportunity of interest &mdash; the id will be in the URL.

<em>Here\'s an example using the id 511. (Note that this opportunity may not be available in your region).</em>

[restore-strategies-opportunity id="511"]';

        $search_example_copy = '<b>The fastest way to display several similar opportunities on a page</b> is to use the <b>search shortcode</b>. Based on a specific, hardcoded search it displays a list of opportunities. The search shortcode has <em>7 optional parameters</em>.
<ol>
 	<li><strong>q</strong>. A search query, some text you want to search for</li>
 	<li><strong>issues</strong>. Issues you want to filter by, possible issues include Children/Youth, Elderly, Family/Community, Foster Care/Adoption, Healthcare, Homelessness, Housing, Human Trafficking, International/Refugee, Job Training, Sanctity of Life, Sports, &amp; Incarceration</li>
 	<li><strong>regions</strong>. Geographical regions the opportunity is located in. Possible regions include North, Central, East, West, &amp; Other</li>
 	<li><strong>times</strong>. Times of day the opportunity occurs at. Possible times include Morning, Mid-Day, Afternoon, &amp; Evening</li>
 	<li><strong>days</strong>. Days of the week the opportunity occurs on. Possible days include Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, &amp; Sunday</li>
 	<li><strong>type</strong>. Type of opportunity. Possible types include Gift, Service, &amp; Training</li>
 	<li><strong>group_type</strong>. Volunteer group type. Possible types include Individual, Group, &amp; Family</li>
</ol>
<em>Here\'s an example using all of the parameters.</em>

[restore-strategies-search q="foster care" issues="Children/Youth,Sports" regions="North,Central" times="Morning,Evening" days="Monday,Thursday" type="Service,Training" group_type="Individual,Group"]';

    $searchbox_example_copy = '<em><small>(Note the search box functionality may not work correctly in post preview or if permalinks are set to Plain.)</small></em>

    Display a search box so users can search opportunities using the <b>search box</b> shortcode. The search box shortcode has <em>5 optional parameters</em>.
<ol>
    <li><strong>advanced</strong>. Display an Advanced search button & advanced search options. Defaults to "no". <em>Possible values: yes|no.</em></li>
    <li><strong>collapse</strong>. If advanced search is activated, this parameter indicates whether to show or collapse the advanced search layout by default. If hidden, clicking "Advanced" will reveal the layout, and vice versa. Defaults to "no". <em>Possible values: yes|no.</em></li>
    <li><strong>prefix</strong>. Put text here that you would like to include in all of the searches done with this search box.</li>
    <li><strong>hide</strong>. In the advanced search layout, select which default checkbox categories to hide.</li>
    <li><strong>category</strong>. In the advanced search layout, create a category of checkboxes. The first item in this will be the name of the category, &amp; the rest will be the checkbox options.</li>
    </ol>
    In this example advanced search options will be displayed & collapsed by default, every search will be prefixed with the words "foster care", the Issues &amp; Groups categories will not be displayed, &amp; an Engagements category will be displayed with the Prevent, Support, Foster, Sustain, &amp; Remain as options.

    [restore-strategies-search-box advanced="yes" collapse="yes" prefix="foster care" hide="Issues,Groups" category="Engagements,Prevent,Support,Foster,Sustain,Remain"]

    In this example advanced search options will not be displayed &amp; searches will not be prefixed with anything.

    [restore-strategies-search-box]';

    $featured_example_copy = '<b>Display featured opportunities</b>. You may feature any number of opportunities via your <a href="https://www.citysync.church/admin/featured-opps" target="_blank">City Sync admin</a>.

    [restore-strategies-featured-opportunities]';

$slider_example_copy =  '<b>Create a slider in which a collection of opportunities is displayed</b>. You can use any of the [[restore-strategies-opportunity]], [[restore-strategies-featured-opportunities]], &amp; [[restore-strategies-search]] shortcodes with the slider.

<em>Here is an example slider of your featured opportunities.</em>

[restore-strategies-slider]
[restore-strategies-featured-opportunities]
[/restore-strategies-slider]

The slider shortcode has <em>three optional parameters</em>.
<ol>
 	<li><strong>width</strong>. The width of the slider. <em>Defaults to 100%</em>.</li>
 	<li><strong>auto</strong>. Whether or not the slider should auto play. <em>Defaults to "yes". Possible values: yes|no.</em></li>
 	<li><strong>speed</strong>. Speed of the slider (in milliseconds). <em>Default is 3000.</em></li>
</ol>
<em>Here is an example of a slider that\'s 75% of the width of the element it\'s in, it does slide automatically, it slides every 3000 milliseconds.</em>

[restore-strategies-slider width="75%"  auto="yes" speed="3000"]
[restore-strategies-opportunity id="511"]
[restore-strategies-opportunity id="512"]
[/restore-strategies-slider]';


        /**
         * Search for restore_strategies post types, publish if exist,
         * if not create
         */
        $posts = query_posts(array(
            'post_type' => 'restore_strategies'
        ));

        if (count($posts) > 1) {
            for ($id = 0; $id < count($posts); $id++) {
                $posts[$id]->post_status = 'publish';
                wp_update_post($posts[$id]);
            }
        }
        else {
            wp_insert_post(
                array(
                    'post_title' => 'Signup',
                    'post_content' => '[restore-strategies-signup-form]',
                    'comment_status' => 'closed',
                    'post_type' => 'restore_strategies',
                    'post_status' => 'publish',
                    'post_name' => 'form'
                ),
                true
            );

            wp_insert_post(
                array(
                    'post_title' => 'Volunteer Opportunity',
                    'post_content' => '[restore-strategies-opportunity]',
                    'comment_status' => 'closed',
                    'post_type' => 'restore_strategies',
                    'post_status' => 'publish',
                    'post_name' => 'show'
                ),
                true
            );

        }

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Opportunity',
                'post_content' => $opp_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Featured Opportunities',
                'post_content' => $featured_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Search',
                'post_content' => $search_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Search Box',
                'post_content' => $searchbox_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );

        wp_insert_post(
            array(
                'post_title' => '[Restore Strategies Example] Slider',
                'post_content' => $slider_example_copy,
                'comment_status' => 'closed',
                'post_type' => 'page',
                'post_status' => 'draft',
            ),
            true
        );
	}
}
