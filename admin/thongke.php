<?php 
    use Carbon\Carbon;
    use Carbon\CarbonInterval;
    include('../db/connect.php');
    require '../carbon/autoload.php';


    if(isset($_POST['thoigian'])) {
        $thoigian = $_POST['thoigian'];
    }else {
        $thoigian = '';
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString(); 
    }

    if($thoigian == '7ngay') {
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString(); 
    }else if($thoigian == '28ngay') {
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString(); 
    }else if($thoigian == '90ngay') {
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString(); 
    }else if($thoigian == '365ngay') {
        $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString(); 
    }


        // $subday = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString(); 
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sql = "SELECT * FROM tbl_thongke WHERE ngaydat BETWEEN '$subday' AND '$now' ORDER BY ngaydat DESC";
        $sql_query = mysqli_query($con, $sql);

        while($val = mysqli_fetch_array($sql_query)) {
            $char_data[] = array(
                'date' => $val['ngaydat'],
                'order' => $val['donhang'],
                'sales' => $val['doanhthu'],
                'quantity' => $val['soluongban'],
            );
        }
        echo $data = json_encode($char_data)
?>