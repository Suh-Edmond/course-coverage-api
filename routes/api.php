<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['middleware' => 'auth:api'], function(){

    //get all available courses
    Route::get('courses', 'CourseController@index');
    //route for adding all courses
    Route::post('courses', 'CourseController@store');
    //update course
    Route::put('courses/{course}', 'CourseController@update');
    //delete course
    Route::delete('courses/{course}', 'CourseController@destory');
    //route for getting all schedule
    Route::get('courses/schedules', 'CourseScheduleController@index');
    //route for adding all schedule
    Route::post('courses/schedules', 'CourseScheduleController@store');
    //route for updating all schedule
    Route::put('courses/schedules/{course_schedule}', 'CourseScheduleController@update');
    //route for deleting all schedule
    Route::delete('courses/schedules/{course_schedule}', 'CourseScheduleController@destroy');
    //get schedules for course by lecturer
    Route::get('lecturer/courses/schedules', 'CourseScheduleController@getCourseSchedulesByLecturer');
    //get schedules for course delegates
    Route::get('course_delegate/courses/schedules', 'CourseScheduleController@getCourseSchedulesByCourseDelegate');
    //route for getting all activities
    Route::get('activities', 'ActivityController@index');
    //add courses for a particular  lecturer
    Route::post('lecturer/courses/add', 'TeachesController@store');
    //get all courses for a particuler lecturer
    Route::get('lecturer/courses', 'TeachesController@index');
    //getting lecturer for a particular course
    Route::post('/course/lecturers', 'TeachesController@getCourseLecturers');
    //get number of courses for a particular lecturer
    Route::get('lecturer/courses/total', 'TeachesController@getCourseNumber');
    //delete a lecturer's course
    Route::delete('lecturer/courses/{course}', 'TeachesController@destroy');
    //get course topics
    Route::get('course/topics', 'TopicController@index');
    //update a topic
    Route::put('course/topics/{id}', 'TopicController@update');
    //deleted a topic
    Route::delete('course/topics/{id}', 'TopicController@destroy');
    //get number of topics
    Route::get('course/topics/total', 'TopicController@getTopicNumber');
    //get activities for a topic
    Route::get('course/topics/{id}/activities', 'TopicController@getTopicActivity');
    //get course for a particular course delegate
    Route::get('course_delegate/enroll_course', 'AttendsController@index');
    //get number of course for a particular course delegate
    Route::get('course_delegate/enroll_course/total', 'AttendsController@getNumberOfCoursePerCourseDelegate');
    //get number of course delegate for a lecturer
    Route::get('lecturer/courses/course_delegates/number', 'UserController@getNumberCourseDelegates');
    //get course outline
    Route::get('course/outline', 'OutlineController@index');
    //route for recording course work
    Route::post('course/record_work_done', 'CoverageController@store');
    //get coverage statistic for course
    Route::post('course/coverage_statistic', 'CoverageController@index');
    //get number of topics per course
    Route::get('course/coverage_statistics/topics_covered', 'CoverageController@getNumberOfCoveredTopics');
    //Route to add a feedback for a course
    Route::post('course/feedback','FeedbackController@store');
    //route to get feedback by a year for a course
    Route::get('course/feedback', 'FeedbackController@index');
    // //add course outline
     Route::post('course/outline', 'OutlineController@store');
    //get user details
    Route::get('user_details', 'UserController@getUserDetails');
    //update user detail
    Route::put('user_details/edit', 'UserController@update');
    //get authentication id for course delegate
    Route::get('course_delegate/access_id', 'AccessIdController@generateId');
    //set the user type
    Route::post('user/get_type', 'UserController@getType');
    //route to for getting usertype
    Route::post('user/set_type', 'UserController@setUserType');
    Route::post('user', 'UserController@loginUser');
    //route for user logging out  a user from the system
    Route::get('auth/logout', 'AuthController@logout');





