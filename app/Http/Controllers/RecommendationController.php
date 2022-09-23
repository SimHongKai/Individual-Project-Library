<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FPGrowth\FPGrowth;
use App\Models\Book;
use DB;

class RecommendationController extends Controller
{
    /**
     * Runs the Recommendation FPGrowth algorithm and SQL Queries to get 0-3 ISBN as recs
     * 
     * @return Array
     */
    public function getRecommendationsISBN($ISBN)
    {
        $limit = 50;
        $floor = 10;

        // get list of user_ids
        $user_id_array = $this->getBorrowedUserIds($ISBN, $limit, $floor);
        // if not enough data return empty array
        if ($user_id_array == null){
            return [];
        }
        // get ISBN records to be passed to FPGrowth for Patterns
        $ISBN_array = $this->getBorrowedISBNs($user_id_array, $limit);
        
        // 20% support
        $support = count($ISBN_array)/10;
        // confidence set to 1 so will get rules that always contain the ISBN wanted as consequent
        $confidence = 1;
        // create the FPGrowth based on above variables
        $fpgrowth = new FPGrowth($support, $confidence);
        // run FPGrowth on the Array of ISBN
        $fpgrowth->run($ISBN_array);
        // get patterns and rules
        $patterns = $fpgrowth->getPatterns();
        $rules = $fpgrowth->getRules();

        $ruleCount = count($rules);

        $recommendations = [];
        // get 3 ISBN from the antecedent of rules. Consequent is always the passed ISBN
        // go in reverse order for highest support rules
        for ($i = $ruleCount-1; $i >= 0; $i--){
            // skip rules with 2 in one consequent, they will pop up again anyways due to the way FPTree is created
            if (strlen($rules[$i][0]) > 13){
                continue;
            }
            array_push($recommendations, $rules[$i][0]);
            if (count($recommendations) >= 5){
                break;
            }
        }

        return $recommendations;

        // return view('debug.varDump')->with(compact('patterns', 'rules', 'user_id_array', 'ISBN_array', 'recommendations'));
    }

    /**
     * returns Null or List of user IDs that have recently borrowed the passed ISBN
     * 
     * @return Array/Null
     */
    public function getBorrowedUserIds($ISBN, $limit, $floor){

        // select list of recent (last 50) user ids that have borrowed the particular ISBN
        $user_id_list = DB::query()->select('user_id')
                        ->fromSub(function ($query) use($ISBN){
                            $query->from('borrowhistory')->where('ISBN', $ISBN);
                        }, 'sub')
                        ->groupBy('user_id')
                        ->orderBy(DB::raw('MAX(borrowed_at)'), 'DESC')
                        ->limit($limit)
                        ->get()->toArray();
        /* SELECT `user_id` FROM (SELECT `user_id`, `borrowed_at` FROM `borrowhistory` WHERE `ISBN` = '1234523876954') AS Sub 
        GROUP BY `user_id` ORDER BY MAX(`borrowed_at`) DESC */

        // if below certain number of users abort and return null
        if (count($user_id_list) < $floor){
            return null;
        }

        // convert query result to array
        $user_id_array = [];
        foreach($user_id_list as $user_id){
            array_push($user_id_array, $user_id->user_id);
        }

        return $user_id_array;
    }

    /**
     * returns Null or List of ISBNs grouped by passed User IDs
     * 
     * @return Array/Null
     */
    public function getBorrowedISBNs($user_id_array, $limit){

        /* SELECT GROUP_CONCAT(DISTINCT `ISBN`),`user_id` FROM `borrowhistory` GROUP BY `user_id` WHERE*/
        // get list of ISBN's borrowed by the recent users
        $borrowTransactions = DB::table('borrowHistory')->select(DB::raw('GROUP_CONCAT(DISTINCT ISBN) as ISBN_list'))
                                ->groupBy('user_id')
                                ->whereIn('user_id', $user_id_array)
                                ->limit($limit)
                                ->get()->toArray();

        // create array of ISBN to be passed to Algorithm, each row of array is a user
        $ISBN_array = [[]];
        $i = 0;
        foreach($borrowTransactions as $borrowTransaction){
            $ISBNList = explode(',', $borrowTransaction->ISBN_list);
            $ISBN_array[$i++] = $ISBNList;
        }

        return $ISBN_array;
    }

    /**
     * returns Null or List of ISBNs that are Also borrowed by other similar users
     * 
     * @return Array/Null
     */
    public function getSimilarISBNs($user_id = '1'){
        $similarUsers = $this->getSimilarUserIds($user_id);

        // $similarUsers = []; to test result when empty. will return empty array
        /* SELECT DISTINCT ISBN FROM `borrowhistory` WHERE `user_id` IN $similarUsers not borrowed already by user*/
        $similarISBNs = DB::table('borrowHistory')->select('ISBN')->distinct()
                        ->whereIn('user_id', $similarUsers)
                        ->whereNotIn('ISBN', function ($query) use($user_id){
                            $query->select('ISBN')->distinct()
                            ->from('borrowhistory')
                            ->where('user_id', $user_id);
                        })
                        ->limit(5)
                        ->inRandomOrder()
                        ->get();

        // convert query result to array
        $similarISBNsArray = [];
        foreach($similarISBNs as $similarISBN){
            array_push($similarISBNsArray, $similarISBN->ISBN);
        }

        return $similarISBNsArray;
        // view('debug.varDump')->with(compact('similarISBNsArray', 'similarUsers'));
    }

    /**
     * returns Null or List of user ids that are have similar borrows to current user
     * 
     * @return Array/Null
     */
    public function getSimilarUserIds($user_id){

        /* SELECT COUNT(DISTINCT `ISBN`) AS 'Match', `user_id` FROM `borrowhistory` 
        WHERE `ISBN` IN (SELECT DISTINCT `ISBN` FROM `borrowhistory` WHERE `user_id`='1') 
        GROUP BY `user_id` ORDER BY COUNT(DISTINCT `ISBN`) DESC LIMIT 3 OFFSET 1 */
        // get the top users that have the highest number of similar borrows(matches) as the current user.
        $similarUsers = DB::table('borrowHistory')->select('user_id') //DB::raw('COUNT(DISTINCT `ISBN`) AS `Match`')
                                ->whereIn('ISBN', function ($query) use($user_id){
                                    $query->select('ISBN')->distinct()
                                    ->from('borrowhistory')
                                    ->where('user_id', $user_id);
                                })
                                ->groupBy('user_id')
                                ->orderBy(DB::raw('COUNT(DISTINCT ISBN)'), 'DESC') 
                                ->limit(5)                       
                                ->offset(1)
                                ->get();

        // convert query result to array
        $similarUsersArray = [];
        foreach($similarUsers as $similarUser){
            array_push($similarUsersArray, $similarUser->user_id);
        }

        return $similarUsersArray;
    }
}
