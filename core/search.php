<?php

// @$user_search = $_GET;





// function build_query($user_search){

//     $search_query = "select * from tg_house_location";

//     //Extract the search keywords into an array
//     $clean_search = str_replace(',',' ',$user_search);
//     $search_words = explode(' ', $clean_search);
//     $final_search_words = array();
//     if(count($search_words)>0){
//         foreach($search_words as $word){
//             if(!empty($word)){
//                 $final_search_words[]=$word;
//             }
//         }
//     }
//     // Generate a where_clause using all of the search keywords
//     $where_list = array();
//     if(count($final_search_words)>0){
//         foreach ($final_search_words as $word){
//             $where_list[] = "country like '%word%'";
//         }
//     }
//     $where_clause = implode('or', $where_list);

//     // Add the keyword where_clause to the search query
//     if(!empty($where_clause)){
//         $search_query .= " where $where_clause";
//     }

//     return $search_query;
// }

// ?>