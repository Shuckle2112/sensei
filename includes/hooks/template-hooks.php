<?php
/**
 * Sensei Template Hooks
 *
 * Action/filter hooks used for Sensei functionality hooked into Sensei Templates
 *
 * @author 		WooThemes
 * @package 	Sensei
 * @category 	Hooks
 * @version     1.9.0
 */

/***************************
 *
 * TEMPLATE SYSTEM HOOKS
 *
 ***************************/

//This hook allow us to change the template WordPress loads for a given page/post_type @since 1.9.0
add_filter( 'template_include', array ( 'Sensei_Templates', 'template_loader' ), 10, 1 );


/***************************
 *
 * COURSE ARCHIVE HOOKS
 *
 ***************************/
// deprecate the archive content hook @since 1.9.0
add_action( 'sensei_archive_before_course_loop', array ( 'Sensei_Templates', 'deprecated_archive_hook' ), 10, 1 );

// Course archive title hook @since 1.9.0
add_action('sensei_archive_title', array( 'WooThemes_Sensei_Course', 'archive_header' ), 10, 0 );

// add the course image above the content
add_action('sensei_course_content_before', array( Sensei()->course, 'course_image' ) ,10, 1 );

// add course content title to the courses on the archive page
add_action('sensei_course_content_before', array( 'Sensei_Templates', 'the_title' ) ,11, 1 );

/***************************
 *
 * SINGLE COURSE HOOKS
 *
 ***************************/

// @1.9.0
// add deprecated action hooks for backwards compatibility sake
// hooks on single course page: sensei_course_image , sensei_course_single_title, sensei_course_single_meta
add_action('sensei_single_course_content_inside_before', array( 'Sensei_Templates', 'deprecated_single_course_inside_before_hooks' ), 80);

// @1.9.0
// hook the single course title on the single course page
add_action( 'sensei_single_course_content_inside_before', array( Sensei()->frontend, 'sensei_single_title' ), 10 );

// @1.9.0
//Add legacy hooks deprecated in 1.9.0
add_action( 'sensei_single_course_content_inside_before', 'course_single_meta', 10 );

// @1.9.0
// Filter the content and replace it with the excerpt if the user doesn't have full access
add_filter( 'the_content', array('WooThemes_Sensei_Course', 'single_course_content' ) );

// @1.9.0
// Deprecate lessons specific single course hooks
add_action( 'sensei_single_course_content_inside_after', array( 'Sensei_Templates','deprecate_sensei_course_single_lessons_hook' ) );

// @1.9.0
// Deprecate single course content hooks and in favor of simply calling the_content.
add_action( 'sensei_single_course_content_inside_after', array( 'Sensei_Templates', 'deprecated_single_main_content_hook') );

// @1.9.0
// Deprecate hooks into the single course modules
add_action('sensei_single_course_modules_before', array('Sensei_Templates','deprecate_module_before_hook' ) );
add_action('sensei_single_course_modules_after', array('Sensei_Templates','deprecate_module_after_hook' ) );

// @since 1.9.0
// add the single course lessons title
add_action( 'sensei_single_course_content_inside_after' , array( 'WooThemes_Sensei_Course','the_course_lessons_title'), 9 );

// @since 1.9.0
// hooks in the course lessons query and remove it at the end
add_action( 'sensei_single_course_lessons_before', array('WooThemes_Sensei_Course','load_single_course_lessons_query' ) );
add_action( 'sensei_single_course_lessons_after', array( 'WooThemes_Sensei_Utils','restore_wp_query' ));

// @since 1.9.0
// add post classes to the lessons on the single course page
add_filter( 'post_class', array( 'WooThemes_Sensei_Lesson', 'single_course_lessons_classes' ) );

// @since 1.9.0
// lesson meta information on the single course page
add_action( 'sensei_single_course_inside_before_lesson', array('WooThemes_Sensei_Lesson','the_lesson_meta') , 5);

//@since 1.9.0
// lesson image
add_action( 'sensei_single_course_inside_before_lesson', array('WooThemes_Sensei_Lesson','the_lesson_thumbnail') , 8);

//@since 1.9.0
// lesson custom excerpts
add_action( 'get_the_excerpt', array( 'WooThemes_Sensei_Lesson', 'alter_the_lesson_excerpt' ) );

// @since 1.9.0
// run a deprecated hook for backwards compatibility sake
add_action( 'sensei_single_course_modules_before', array( 'Sensei_Core_Modules', 'deprecate_sensei_single_course_modules_content'  ) );

// @since 1.9.0
// hook in the module loop intialization functionality
add_action( 'sensei_single_course_modules_before', array( 'Sensei_Core_Modules', 'setup_single_course_module_loop' ) );

// @since 1.9.0
// hook in the module loop destructor functionality
add_action( 'sensei_single_course_modules_after', array( 'Sensei_Core_Modules', 'teardown_single_course_module_loop' ) );