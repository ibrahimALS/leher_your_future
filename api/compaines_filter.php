<?php
require_once(__DIR__ . '/dbcon.php');
require_once(__DIR__ . '/../vendor/autoload.php');

// ===========================
$city = isset($_GET['city']) ? trim($_GET['city']) : '';
$cname = isset($_GET['cname']) ? trim($_GET['cname']) : '';
$term = isset($_GET['term']) ? trim($_GET['term']) : '';
$skill = isset($_GET['skill']) ? trim($_GET['skill']) : '';
$radius = isset($_GET['radius']) ? (float) trim($_GET['radius']) : 0;
// Vienna 48.228734, 16.06185116.061851
$user_lat = isset($_GET['user_lat']) ? trim($_GET['user_lat']) : 0;
$user_lng = isset($_GET['user_lng']) ? trim($_GET['user_lng']) : 0;
if (($user_lat == 0 or $user_lat == '') or ($user_lng == 0 or $user_lng == '')) {
        $client_ip = $_SERVER['REMOTE_ADDR'];
        //$vienna_ip=178.115.61.237
        //$gaza_ip=158.140.97.248
        // $client_ip = '158.140.97.248';
        $request = file_get_contents("http://ip-api.com/json/$client_ip");
        $ip = json_decode($request);
        $user_lat = isset($ip->lat) ? trim($ip->lat) : 0;
        $user_lng = isset($ip->lon) ? trim($ip->lon) : 0;
}
$perPage = 5;
// Calculate Total pages
$countquery = "SELECT count(*) 
                FROM posts as P 
                inner JOIN company as C on C.id = P.company_id 
                inner JOIN worldcities as WC on WC.city = P.city
                WHERE 
                P.city LIKE '%$city%' 
                and 
                C.name LIKE '%$cname%' 
                and 
                P.title LIKE '%$term%'
                and
                P.skill LIKE '%$skill%'
                 ";
$countquery .= " and WC.country = 'Austria'";
if ($radius > 0) {
        $countquery .= " and (ROUND(ST_Distance_Sphere(point($user_lng,$user_lat),point(WC.lng,WC.lat))/1000,1)) <= $radius ";
}
$stmt = $con->query($countquery);
$total_results = $stmt->fetchColumn();
$total_pages = ceil($total_results / $perPage);
// Current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$starting_limit = ($page - 1) * $perPage;
// Query to fetch 
$query = "SELECT  
                  C.name company_name, 
                  C.email company_email, 
                  C.id company_id , 
                  P.title post_title , 
                  P.id post_id , 
                  P.salary post_salary, 
                  P.skill post_skill, 
                  P.city post_city,
                  WC.city wc_city,
                  WC.lat wc_lat,
                  WC.lng wc_lng ,
                  $user_lat as user_lat,      
                  $user_lng as user_lng ,
                  ROUND(ST_Distance_Sphere(point($user_lng,$user_lat),point(WC.lng,WC.lat))/1000,1) as distance,
                  CONCAT('company/images/',P.image) as post_image   
          FROM posts as P 
          inner JOIN company as C on C.id = P.company_id 
          inner JOIN worldcities as WC on WC.city = P.city
          WHERE 
          P.city LIKE '%$city%' 
          and 
          C.name LIKE '%$cname%' 
          and 
          P.title LIKE '%$term%'
          and
          P.skill LIKE '%$skill%'
          ";
if ($radius > 0) {
        $query .= " and (ROUND(ST_Distance_Sphere(point($user_lng,$user_lat),point(WC.lng,WC.lat))/1000,1)) <= $radius ";
}
$query .= " and WC.country = 'Austria'";
$query .= " LIMIT $starting_limit,$perPage";
// Fetch all users for current page
$result = $con->query($query)->fetchAll(\PDO::FETCH_ASSOC);
header('content-type: application/json');
print_r(json_encode([
        'result' => $result,
        'pages' => $total_pages,
        'radius' => $radius,
]));
