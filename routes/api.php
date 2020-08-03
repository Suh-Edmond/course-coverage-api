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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//route for getting all courses
Route::get('courses', 'CourseController@index');
// route for getting all course names
Route::get('course_name', 'CourseController@getCourseNames');
//route for showing a courses
Route::get('courses/{course}', 'CourseController@show');
//route for adding all courses
Route::post('courses', 'CourseController@store');
//route for updating all courses
Route::put('courses/{course}', 'CourseController@update');
//route for deleting all courses
Route::delete('courses/{course}', 'CourseController@destroy');
 

//Route for show course_delegates
Route::get('course_delegates', 'CourseDelegateController@getCourseDelegates');

Route::get('course_delegates/{course_delegate}', 'CourseDelegateController@show');
//Route for adding  course_delegates
Route::post('course_delegate', 'CourseDelegateController@store');
//Route for updating all course_delegates
Route::put('course_delegates/{course_delegate}', 'CourseDelegateController@update');
//Route for deleting all course_delegates
Route::delete('course_delegates/{course_delegate}', 'CourseDelegateController@destroy');


//route for getting all schedule
Route::get('course_schedules', 'CourseScheduleController@index');
//route for adding all schedule
Route::post('course_schedules', 'CourseScheduleController@store');
//route for showing all schedule
Route::get('course_schedules/{course_schedule}', 'CourseScheduleController@show');
//route for updating all schedule
Route::put('course_schedules/{course_schedule}', 'CourseScheduleController@update');


//route for gettng all lecturers
Route::get('lecturers', 'LecturerController@index');
//route for show a lecturers
Route::get('lecturers/{lecturer}', 'LecturerController@show');
//route for adding all lecturers
Route::post('lecturers', 'LecturerController@store');
//route for updating all lecturers
Route::put('lecturers/{lecturer}', 'LecturerController@update');
//route for deleting all lecturers
Route::delete('lecturers/{lecturer}', 'LecturerController@destroy');
 



//route for getting all topics
Route::get('course_topics', 'TopicController@index');
//route for adding all topics
//Route::post('course_topics', 'TopicController@store');
//get course topic number
Route::post('course_topic_number', 'TopicController@getTopicNumber');
//get coverage statistic for course
Route::post('coverage_statistics', 'CoverageController@index');
//get total number of covered topics
Route::post('get_number_of_covered_topics', 'CoverageController@getNumberOfCoveredTopics');
//route for recording course work
Route::post('record_course_work', 'CoverageController@store');

//Route::get('topics_covered', 'ReportController@getResults');


//Route::get('topic_activity', 'HasActivityController@index');

//Route::post('topic_activity', 'HasActivityController@store');

Route::get('activities', 'ActivityController@index');

Route::post('get_topics', 'TopicController@getTopicName');

Route::get('teaches', 'TeachesController@index');

//getting lecturer for a particular course
Route::post('/course_lecturer', 'TeachesController@getCourseLecturers');
//add courses for a particular  lecturer
Route::post('/courses_by_lecturer', 'TeachesController@addLecturerCourse');

Route::post('/get_course_lecturer', 'TeachesController@getCourseOfLecturer');

Route::post('/outline', 'OutlineController@store');
 


 
