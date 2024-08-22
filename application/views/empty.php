<?php

class Masters_model extends CI_Model {

    public function importData($table, $data) {

        $res = $this->db->insert($table, $data);
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function importImageData($table, $data) {

        $res = $this->db->insert_batch($table, $data);
        if ($res) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_location_data($id){
        $this->db->where('location_id =', $id);
        $query = $this->db->get('sa_doc_upload');
        return $query->result_array();
    }


    function get_cc_table_submitted() {
        $user = $this->session->userdata('emp_no');
        $this->db->where('created_by =', $user);
        $this->db->where('status !=',"Saved");
        $query = $this->db->get('user_information');
        return $query->result_array();
    }

    function get_ct_table_submitted() {
        $emp_no = $this->session->userdata('emp_no');
        $this->db->select('user_information.*');
        $this->db->where('cluster_id =',$emp_no);
        $this->db->where('status !=',"Saved");
        $this->db->where('ct_review =',"");
        $query = $this->db->get('user_information');
        return $query->result_array();
    }

    function get_ct_table_updated() {
        $this->db->where('status !=',"Saved");
        $this->db->where('ct_review !=',"Saved");
        $query = $this->db->get('user_information');
        return $query->result_array();
    }

    ///-------///
    function fetch_row($table, $col, $id) { 
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function verifyUser($array, $table) {
        $this->db->where($array);
        $records = $this->db->get($table)->row_array();
        //echo $this->db->last_query(); exit;
        return $records;
    }

    function verify_data($array, $table) {
        $this->db->where($array);
        $records = $this->db->get($table);
        return $records->result();
    }

    function verify_data2($array, $table ,$col ,$val) {
        $this->db->where($array);
        $this->db->where("$col != ", $val);
        $records = $this->db->get($table);
        return $records->result();
    }

    function get_business_grouped($table) {
        $this->db->where('role =','CC');
        $this->db->where('status =','1');
        $this->db->select('*');
        $this->db->group_by('business');
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function get_table($table) {
        $query = $this->db->get($table); 
        return $query->result_array();
    }

    function get_table_approval_rsm_log($table) {
        $this->db->select('user_information.*');
        $this->db->where('ct_review =',"1");
        $this->db->where('rsm_approval =',"Approved");
        $this->db->where('rsmi_approval ',"");
        $this->db->group_by('user_information.id');
        $query = $this->db->get('user_information');
        return $query->result_array(); 
    } 

    function get_table_approval_rsmi_log($table) {
        $this->db->select('user_information.*');
        $this->db->where('approved_by =', "");
        $this->db->where('rsm_approval =',"Approved");
        $this->db->where('rsmi_approval ',"Approved");
        $this->db->group_by('user_information.id');
        $query = $this->db->get('user_information');
        return $query->result_array(); 
    } 
 
    function get_table_approval_ct_log($table) {
        $emp_no = $this->session->userdata('emp_no');
        $this->db->select('user_information.*');
        $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
        $this->db->where('masters.RSM_emp_no', $emp_no);
        $this->db->where('user_information.status !=', "Saved");
        $this->db->where('user_information.approved_by =', "");
        $this->db->where('user_information.rsm_app_by =', "");
        $this->db->where('user_information.ct_review =',"1");
        $this->db->group_by('user_information.id');
        $query = $this->db->get('user_information');
        return $query->result_array(); 
    } 


    public function get_all_funneled_data($postData,$tb_name){

        $emp_no = $this->session->userdata('emp_no');
 
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (name like '%" . $searchValue . "%' or 
            mobile like '%" . $searchValue . "%' or 
            created_by like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        $this->db->where('created_by =',$emp_no);
        // $this->db->Orwhere('created_by !=',"Customer");
        $this->db->where('status =','Saved');
        
        $records = $this->db->get()->result();
        
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('created_by =',$emp_no);
          $this->db->where('status =','Saved');

        $records = $this->db->get()->result();

        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('created_by =',$emp_no);
            $this->db->where('status =','Saved');
            $this->db->order_by('id', 'desc');  # or desc
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get()->result();
        $data = array();

        foreach ($records as $record)
        {	
            if($record->rsm_approval=="Rejected"){
                $rsm_status='<b class="text-danger">Hold</b>';
            }
            else{
                $rsm_status='';
            }
            $remarks = "<b>RSM</b>: ".$record->rsm_remark."<br>";


            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div>';
           

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                        <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
           
            $action = '<button class="btn btn-primary btn-mini " title="Edit" onclick="edit_business_pop('."'".$record->id."'".');">
                            <i class="fa fa-pencil"></i>
                        </button>   
                        ';
                $data[] = array(
                    "id" => $record->id,
                    "name" => $record->name,
                    "mobile" => $record->mobile,
                    "shop_address" => $record->shop_address,
                    "town_code" => $record->town_code,
                    "score" => $score,
                    "proof_type" => $proof_type,
                    "created_by" => $record->created_by,
                    "rsm_status" => $rsm_status,
                    "remarks" => $remarks,
                    "action" => $action,
                );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }
 
    public function get_customer_entered_data($postData,$tb_name){
 
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (name like '%" . $searchValue . "%' or 
            mobile like '%" . $searchValue . "%' or 
            created_by like '%" . $searchValue . "%' or 
            shop_address like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        $this->db->where('role', 'MP');
        $query = $this->db->get('users')->result();

        foreach ($query as $query){

        ## Total number of records without filtering
            $this->db->select('count(*) as allcount');
            $this->db->from($tb_name);
            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;
            $this->db->where('status =','1');
            $records = $this->db->get()->result();
            
            $totalRecords = $records[0]->allcount;

            ## Total number of record with filtering
            $this->db->select('count(*) as allcount');
            $this->db->from($tb_name);
            if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;
            $this->db->where('status =','1');
            $records = $this->db->get()->result();

            $totalRecordwithFilter = $records[0]->allcount;
            

            ## Fetch records
            $this->db->select('*');
            $this->db->from($tb_name);

            if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('status =','1');
            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;
            $this->db->order_by('id', 'desc');  # or desc
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get()->result();
            $data = array();

            foreach ($records as $record)
            {	
                if($record->sh_approval=="Rejected"){
                    $sh_status='<b class="text-danger">Hold</b>';
                }
                else{
                    $sh_status='';
                }

                if($record->sh_approval == "Approved"){
                    $approve='<b class="text-success">Approved</b>';
                }elseif($record->sh_approval == "Rejected"){
                    $approve='<b class="text-danger">Hold</b>';
                }else{
                    $approve='<b class="text-warning">Pending</b>';
                } 

                if($record->distributor_code != ""){
                    $cc_approve='<b class="text-success">Completed</b>';
                }elseif($record->ct_post_doc_upload == "uploaded" && $record->ct_pre_doc_upload == "uploaded"){
                    $cc_approve='<b class="text-success">Approved</b>';
                }else{
                    $cc_approve='<b class="text-warning">Pending</b>';
                } 

                $approval = '<span>SH :</span><b>'.$approve.'</b><br>
                <span>FCC :</span><b class="text-success">'.$cc_approve.'</b>' ;


                //score 
                if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                    $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
                }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                    $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
                }else{
                    $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
                }

                if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                    $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
                }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                    $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
                }else{
                    $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
                }

                if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                    $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
                }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                    $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
                }else{
                    $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
                }

                $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
                <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
                <div class="row">&nbsp;&nbsp;<span>CT Score &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div>';
            //score


                $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                            <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            

                $action = ' <td>
                <div class="dropdown" >
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="min-width:0;">
                        <li><a href="#" style="width:70%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                        <li><a href="#" style="width:70%;" class="dropdown-item pl-0" onclick="view_detail('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                    </ul>
                </div>
            </td> ';


                    $data[] = array(
                        "id" => $record->id,
                        "action" => $action,
                        "name" => $record->name,
                        "mobile" => $record->mobile,
                        "shop_address" => $record->shop_address,
                        "town_code" => $record->town_code,
                        "score" => $score,
                        "proof_type" => $proof_type,
                        "created_by" => $record->created_by,
                        "approval" => $approval,
                    );
            }
            ## Response
            $response = array(
                "draw" => intval($draw) ,
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
            );
            return $response;
        }

    }

    public function get_customer_funnel_data($postData,$tb_name){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (name like '%" . $searchValue . "%' or 
            mobile like '%" . $searchValue . "%' or 
            created_by like '%" . $searchValue . "%' or 
            shop_address like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
       
        $this->db->where('role', 'MP');
        $query = $this->db->get('users')->result();

        foreach ($query as $query){
            $q = $query->emp_no;
           
            ## Total number of records without filtering
            $this->db->select('count(*) as allcount');
            $this->db->from($tb_name);
            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;
            $this->db->where('status =','Saved');
            $records = $this->db->get()->result();
            
            $totalRecords = $records[0]->allcount;

            ## Total number of record with filtering
            $this->db->select('count(*) as allcount');
            $this->db->from($tb_name);
            if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;
            $this->db->where('status =','Saved');
            $records = $this->db->get()->result();

            $totalRecordwithFilter = $records[0]->allcount;
           
             ## Fetch records
            $this->db->select('*');
            $this->db->from($tb_name);

            if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('status =','Saved');
            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;
            $this->db->order_by('id', 'desc');  # or desc
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get()->result();
            $data = array();

            foreach ($records as $record)
            {	
                if($record->rsm_approval=="Rejected"){
                    $rsm_status='<b class="text-danger">Hold</b>';
                }
                else{
                    $rsm_status='';
                }
                $remarks = "<b>RSM</b>: ".$record->rsm_remark."<br>";


                if($record->sh_approval == "Approved"){
                    $approval='<b class="text-success">Approved</b>';
                }elseif($record->sh_approval == "Rejected"){
                    $approval='<b class="text-danger">Hold</b>';
                }else{
                    $approval='<b class="text-warning">Pending</b>';
                } 
    
                // $remarks = "<b>SH</b>: ".$record->sh_remark."<br>";

                //score 
                if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                    $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
                }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                    $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
                }else{
                    $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
                }

                if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                    $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
                }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                    $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
                }else{
                    $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
                }

                if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                    $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
                }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                    $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
                }else{
                    $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
                }

                $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
                <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
                <div class="row">&nbsp;&nbsp;<span>CT Score &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div>';
                //score

                $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                            <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            
                $action = '<button class="btn btn-primary btn-mini " title="Edit" onclick="edit_business_pop('."'".$record->id."'".');">
                                <i class="fa fa-pencil"></i>
                            </button>   
                            ';
                $data[] = array(
                    "id" => $record->id,
                    "name" => $record->name,
                    "mobile" => $record->mobile,
                    "shop_address" => $record->shop_address,
                    "town_code" => $record->town_code,
                    "score" => $score,
                    "proof_type" => $proof_type,
                    "created_by" => $record->created_by,
                    "approval" => $approval,
                    "rsm_status" => $rsm_status,
                    "remarks" => $remarks,
                    "action" => $action,
                );


            }
              ## Response
            $res = array(
                "draw" => intval($draw) ,
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $data
            );
            
        }
         $response = $res;
         return $response;
    }


    public function get_ct_funneled_data($postData,$tb_name){

        $emp_no = $this->session->userdata('emp_no');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (name like '%" . $searchValue . "%' or 
            mobile like '%" . $searchValue . "%' or 
            created_by like '%" . $searchValue . "%' or 
            shop_address like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        $this->db->where('ct_review =','Saved');
        $this->db->where('cluster_id =',$emp_no);
        
        $records = $this->db->get()->result();
        
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('ct_review =','Saved');
            $this->db->where('cluster_id =',$emp_no);


        $records = $this->db->get()->result();

        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('ct_review =','Saved');
            $this->db->where('cluster_id =',$emp_no);
            $this->db->order_by('id', 'desc');  # or desc
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        $data = array();

        foreach ($records as $record)
        {	
            if($record->rsm_approval=="Rejected"){
                $rsm_status='<b class="text-danger">Hold</b>';
            }
            else{
                $rsm_status='';
            }
            $remarks = "<b>RSM</b>: ".$record->rsm_remark."<br>";
            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                        <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
           

            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div>';
            //score


            $action = '<button type="button" class="btn btn-primary btn-mini" title="Edit" onclick="view_detail('."'".$record->id."'".');">
                            <i class="fa fa-pencil"></i>
                        </button>   
                        ';
            // $action = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#additionaview_('."'".$record->id."'".');">View</button>';

                $data[] = array(
                    "id" => $record->id,
                    "name" => $record->name,
                    "mobile" => $record->mobile,
                    "shop_address" => $record->shop_address,
                    "town_code" => $record->town_code,
                    "score" => $score,
                    "proof_type" => $proof_type,
                    "rsm_status" => $rsm_status,
                    "remarks" => $remarks,
                    "created_by" => $record->created_by,
                    "action" => $action,
                );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    public function get_ct_updated_data($postData,$tb_name){

        $emp_no = $this->session->userdata('emp_no');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (name like '%" . $searchValue . "%' or 
            mobile like '%" . $searchValue . "%' or 
            created_by like '%" . $searchValue . "%' or 
            shop_address like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        $this->db->where('ct_review =','1');
        $this->db->where('cluster_id =',$emp_no);
        
        $records = $this->db->get()->result();
        
        $totalRecords = $records[0]->allcount;

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->where('cluster_id =',$emp_no);
        $this->db->from($tb_name);

        if ($searchQuery != '') 
          $this->db->where($searchQuery);
          $this->db->where('ct_review =','1');

        $records = $this->db->get()->result();

        $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('*');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
            $this->db->where($searchQuery);
            $this->db->where('ct_review =','1');
            $this->db->where('cluster_id =',$emp_no);
            $this->db->order_by('id', 'desc');  # or desc
            $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        $data = array();

        foreach ($records as $record)
        {	
            // $remarks = "<b>SH</b>: ".$record->sh_remark."<br>";
            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
           

            if($record->sh_approval == "Approved"){
                $approve='<b class="text-success">Approved</b>';
            }elseif($record->sh_approval == "Rejected"){
                $approve='<b class="text-danger">Hold</b>';
            }else{
                $approve='<b class="text-warning">Pending</b>';
            } 

            if($record->distributor_code != ""){
                $cc_approve='<b class="text-success">Completed</b>';
            }elseif($record->ct_post_doc_upload == "uploaded" && $record->ct_pre_doc_upload == "uploaded"){
                $cc_approve='<b class="text-success">Approved</b>';
            }else{
                $cc_approve='<b class="text-warning">Pending</b>';
            } 

            $approval = '<span>SH :</span><b>'.$approve.'</b><br>
            <span>FCC :</span><b class="text-success">'.$cc_approve.'</b>' ;


            $img_view='<td><button type="button" class="btn btn-primary" >View</button></td>';
            $detail_view='<td><button type="button" class="btn btn-primary" >View</button></td>';
           
            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $action = ' <td>
                    <div class="dropdown" >
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                        Action <span class="caret"></span>
                        </button> 
                        <ul class="dropdown-menu" style="min-width:0;">
                            <li><a href="#" style="width:70%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                            <li><a href="#" style="width:70%;" class="dropdown-item pl-0" onclick="view_doc_detail('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                        </ul>
                    </div>
                </td> ';

            $data[] = array(
                "id" => $record->id,
                "action" => $action,
                "name" => $record->name,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score,
                "proof_type" => $proof_type,
                "approval" => $approval,
                "created_by" => $record->created_by,
                
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    function updates($table, $data, $col, $id ) {
        $this->db->where($col, $id);
        $this->db->update($table, $data);
        //echo $this->db->last_query();
        //exit;
        return true;
    }

    function get_approved_list_sh_log($table, $col, $id) {
        $this->db->select("$table.*");
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function get_approved_list_rsm_log($table, $col, $id) {
        $emp_no = $this->session->userdata('emp_no');
        $this->db->select("$table.*");
        $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
        $this->db->where('masters.RSM_emp_no', $emp_no);
        $this->db->where("$table.$col", $id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function get_rsmi_entered_filter_log($rsm_name) {
        $this->db->select("user_information.*");
        $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
        $this->db->where('masters.RSM_name', $rsm_name);
        $this->db->where('user_information.approved_by =', "");
        $this->db->where('user_information.rsm_approval =',"Approved");
        $this->db->where('user_information.rsmi_approval ',"Approved");
        $query = $this->db->get('user_information');
        return $query->result_array();
    }

    function get_rsmi_2_filter_log($rsm_name ,$bdm_name) {
        $this->db->select("user_information.*");
        $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
        $this->db->where('masters.RSM_name', $rsm_name);
        $this->db->where('masters.BDM_name', $bdm_name);
        $this->db->where('user_information.approved_by =', "");
        $this->db->where('user_information.rsm_approval =',"Approved");
        $this->db->where('user_information.rsmi_approval ',"Approved");
        $query = $this->db->get('user_information');
        return $query->result_array();
    }


    function get_rsm_filter_log($bdm_emp_no ,$col ,$val ,$array) {
        $user = $this->session->userdata('emp_no');
        $this->db->select("user_information.*");
        $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
        $this->db->where('masters.RSM_emp_no', $user);
        $this->db->where('masters.BDM_emp_no', $bdm_emp_no);
        $this->db->where("user_information.$col",$val);
        $this->db->where($array);
        $query = $this->db->get('user_information');
        return $query->result_array();
    }
   

    function get_approved_list_cod_log($table, $col1, $col2, $id) {
        $this->db->select("$table.*");
        $this->db->where($col1, $id);
        $this->db->where($col2, $id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function get_approved_list_tt_log($table, $col, $id) {
        $this->db->select("$table.*");
        $this->db->where("$col !=", $id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function get_entered_funneled_form_cc_log($table) {
        $this->db->select("$table.*");
        $this->db->where('status =', "Saved");
        $this->db->where('created_by !=', "Customer");
        $this->db->where('sh_approval =', "");
        $query = $this->db->get($table);
        return $query->result_array();
    }

    // -----ct_pending----
    public function get_sa_pending_list($postData,$tb_name){
            
        $response = array(); 
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        // month filter
        
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];

        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.created_by like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
 
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') {   $this->db->where($searchQuery); }
       
        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code", "");
        $this->db->where("sa_app", "");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code", "");
        $this->db->where("sa_app", "");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded");  
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        
        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code", "");
        $this->db->where("sa_app", "");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded");
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();


            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }

            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';

 

            if($record->distributor_code!=""){
                $action_btn_stye="btn-success";
            }else{
                $action_btn_stye="btn-warning";
            }
            $action_btn='<td><button type="button" class="btn '.$action_btn_stye.'" title="Update" onclick="enter_code('."'".$record->id."'".','."'".$record->name."'".','."'".$record->distributor_code."'".');"><i class="fa fa-hand-paper-o"></i></button></td>';

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';

            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score


            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "createddate" => $record->createddate,
                "distributor_code"=>$record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "action_btn" => $action_btn,

            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }



    // ----Sales Admin Rejected List----
    public function get_sa_rejected_list($postData,$tb_name){
            
        $response = array(); 
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        // month filter
        
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];

        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.created_by like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0){
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code", "");
        $this->db->where("sa_app", "Rejected");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code", "");
        $this->db->where("sa_app", "Rejected");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded");  
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        
        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code", "");
        $this->db->where("sa_app", "Rejected");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded");
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();


            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }

            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';

 

            if($record->distributor_code!=""){
                $action_btn_stye="btn-success";
            }else{
                $action_btn_stye="btn-warning";
            }
            $action_btn='<td><button type="button" class="btn '.$action_btn_stye.'" title="Update" onclick="enter_code('."'".$record->id."'".','."'".$record->name."'".','."'".$record->distributor_code."'".');"><i class="fa fa-hand-paper-o"></i></button></td>';

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';

            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score


            $sa ='<b class="text-white bg-danger p-1">'.$record->sa_app.'</b><br><br>
            <span>Remark :</span><b class="text-warning">'.$record->sa_remark.'</b>';

            $sa_remark ='<span class="text-danger">'.$record->sa_remark.'</span>';

            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                // "createddate" => $record->createddate,
                "distributor_code"=>$record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "sa_remark" => $sa_remark, 
                "action_btn" => $action_btn,
                "sa" => $sa,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    public function get_sh_approved_list($postData,$tb_name){
        $emp_no = $this->session->userdata('emp_no');
            
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        // month filter
        
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];

        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '') 
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.created_by like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("cluster_id", $emp_no); 
        $this->db->where("rsm_approval", "Approved"); 
        $this->db->where("sh_approval", "Approved"); 
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("cluster_id", $emp_no); 
        $this->db->where("rsm_approval", "Approved"); 
        $this->db->where("sh_approval", "Approved"); 

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        
        $this->db->where("ct_review ", "1");
        $this->db->where("cluster_id", $emp_no); 
        $this->db->where("rsm_approval", "Approved");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->group_by('user_information.id');

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:95%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>
                ';
            }
            else{
                $sh_doc=''; 
            }
 
            
            if($record->sh_approval == "Approved"){
                $approve='<b class="text-success">Approved</b>';
            }elseif($record->sh_approval == "Rejected"){
                $approve='<b class="text-danger">Hold</b>';
            }else{
                $approve='<b class="text-warning">Pending</b>';
            } 

            if($record->distributor_code != ""){
                $cc_approve='<b class="text-success">Completed</b>';
            }elseif($record->ct_post_doc_upload == "uploaded" && $record->ct_pre_doc_upload == "uploaded"){
                $cc_approve='<b class="text-success">Approved</b>';
            }else{
                $cc_approve='<b class="text-warning">Pending</b>';
            } 

            $approval = '<span>SH :</span><b>'.$approve.'</b><br>
            <span>FCC :</span><b class="text-success">'.$cc_approve.'</b>' ;


            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';


            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score


                $action = ' <td>
                <div class="dropdown" >
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                       Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="min-width:0;">
                        <li><a href="#" style="width:95%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                        <li>'.$sh_doc.'</li>
                        <li><a href="#" style="width:95%;" class="dropdown-item pl-0" onclick="view_all_detail('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                    </ul>
                </div>
            </td> ';  


                $data[] = array(
                    "id" => $record->id,
                    "action" => $action,
                    "name" => $record->name,
                    "createddate" => $record->createddate,
                    "distributor_code"=>$record->distributor_code,
                    "mobile" => $record->mobile,
                    "shop_address" => $record->shop_address,
                    "town_code" => $record->town_code,
                    "score" => $score, 
                    "proof_type" => $proof_type, 
                    "created_by" => $record->created_by, 
                    "approval" => $approval, 
                );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    public function post_upload_form_list($postData,$tb_name){
            
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        // month filter
        
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];

        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.created_by like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded");
        // $this->db->where("parlour_name ", "");
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        // $this->db->where("parlour_name ", "");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded");

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        
        $this->db->where("ct_review ", "1");
        // $this->db->where("parlour_name ", "");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("ct_pre_doc_upload", "uploaded");
        $this->db->group_by('user_information.id');

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:80%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc=''; 
            }

                
            if($record->sh_approval == "Approved"){
                $approve='<b class="text-success">Approved</b>';
            }elseif($record->sh_approval == "Rejected"){
                $approve='<b class="text-danger">Hold</b>';
            }else{
                $approve='<b class="text-warning">Pending</b>';
            } 

            if($record->distributor_code != ""){
                $cc_approve='<b class="text-success">Completed</b>';
            }else{
                $cc_approve='<b class="text-warning">Pending</b>';
            } 

            $approval = '<span>SH :</span><b>'.$approve.'</b><br>
            <span>FCC :</span><b class="text-success">'.$cc_approve.'</b>' ;

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';


                $action = ' <td>
                <div class="dropdown" >
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                       Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="min-width:0;">
                        <li><a href="#" style="width:80%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                        <li>'.$sh_doc.'</li>
                        <li><a href="#" style="width:80%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                    </ul>
                </div>
            </td> ';


                $data[] = array(
                    "id" => $record->id,
                    "action" => $action,
                    "name" => $record->name,
                    "createddate" => $record->createddate,
                    "distributor_code"=>$record->distributor_code,
                    "mobile" => $record->mobile,
                    "shop_address" => $record->shop_address,
                    "town_code" => $record->town_code,
                    "score" => $record->frc_score, 
                    "proof_type" => $proof_type, 
                    "created_by" => $record->created_by, 
                    "approval" => $approval, 
                

                );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    // ----ct distributor_code_creation--- part--
    public function get_sa_code_created_list($postData,$tb_name){
        $mobile = $this->session->userdata('mobile');
        
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // month filter
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.created_by like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code !=", "");
        $this->db->where("sh_approval", "Approved");
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code !=", "");
        $this->db->where("sh_approval", "Approved");
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded");  
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where("distributor_code !=", "");
        $this->db->where("sh_approval", "Approved");
        $this->db->where("ct_pre_doc_upload", "uploaded"); 
        $this->db->where("ct_post_doc_upload", "uploaded"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("parlour_name != ", "");
        $this->db->group_by('user_information.id');

        if ($searchQuery != '')
        $this->db->where($searchQuery);
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }

            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';

            if($record->distributor_code!=""){
                $action_btn_stye="btn-success";
            }else{
                $action_btn_stye="btn-warning";
            }
            $action_btn='<td><button type="button" class="btn '.$action_btn_stye.'" title="Update" onclick="enter_code('."'".$record->id."'".','."'".$record->name."'".','."'".$record->distributor_code."'".','."'".$record->sa_remark."'".');">Update Code
                </button></td>';

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
         

            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "createddate" => $record->createddate,
                "distributor_code"=>$record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "action_btn" => $action_btn,

            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    public function get_ct_doc_upload_log($postData,$tb_name){
        $mobile = $this->session->userdata('mobile');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // month filter
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->where("user_information.ct_review ", "1");
        $this->db->where('user_information.parlour_name ', "");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("rsm_approval", "Approved"); 
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve !=", "Approved"); 
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->where("user_information.ct_review ", "1");
        $this->db->where('user_information.parlour_name ', "");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("rsm_approval", "Approved"); 
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve !=", "Approved"); 
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->where("user_information.ct_review ", "1");
        $this->db->where('user_information.parlour_name', "");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("rsm_approval", "Approved"); 
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve !=", "Approved"); 
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();
          

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }


            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            
            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $action='<button title="Move to Training Team" type="button" class="btn btn-success" onclick="approve_action('."'".$record->id."'".');">Move to Next</button>';


            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "distributor_code" => $record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "action" => $action,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    public function get_ct_doc_sh_approved_log($postData,$tb_name){
        $mobile = $this->session->userdata('mobile');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // month filter
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            users.username like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        $this->db->join('users', "users.emp_no = user_information.tteam_id");

        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') { $this->db->where($searchQuery); }

        $this->db->where("user_information.ct_review ", "1");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        $this->db->join('users', "users.emp_no = user_information.tteam_id");
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $this->db->where("user_information.ct_review ", "1");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        $this->db->join('users', "users.emp_no = user_information.tteam_id");
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        if ($searchQuery != '') { $this->db->where($searchQuery); }
        $this->db->where("user_information.ct_review ", "1");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	
            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();
          
            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }

            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';


            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            
            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $action='<button title="Action" type="button" class="btn btn-success" onclick="approve_action('."'".$record->id."'".');"><i class="fa fa-hand-paper-o"></i></button>';
            
            
            if($record->tteam_id !=""){
                $trainee =$record->tteam_id;
                $this->db->where('emp_no', $trainee);
                $query = $this->db->get('users');
                $get_trainee= $query->result();
    
                $tteam_id = $get_trainee[0]->username;
            }else{ 
                $tteam_id ="";
            }

            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "distributor_code" => $record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "trainee" => $tteam_id, 
                "action" => $action,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    // training team fetch data
    public function get_sh_doc_approved_log($postData,$tb_name ,$array){
        $emp_no = $this->session->userdata('emp_no');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // month filter
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.tteam_id like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') { $this->db->where($searchQuery); }

        // $this->db->where('user_information.parlour_name ', "");
        $this->db->where($array);
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("tteam_id", $emp_no); 
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        // $this->db->where('user_information.parlour_name ', "");
        $this->db->where($array);
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("tteam_id", $emp_no); 
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        if ($searchQuery != '') { $this->db->where($searchQuery); }
        // $this->db->where('user_information.parlour_name', "");
        $this->db->where($array);
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("tteam_id", $emp_no); 
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();
          

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }

            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';


            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            
            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $action='<button title="Action" type="button" class="btn btn-success" onclick="approve_action('."'".$record->id."'".');"><i class="fa fa-hand-paper-o"></i></button>';


            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "distributor_code" => $record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "trainee" => $record->tteam_id, 
                "action" => $action,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    public function get_scored_log($postData,$tb_name){
        $emp_no = $this->session->userdata('emp_no');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // month filter
        $from_date = $postData['from_date'];
        $to_date = $postData['to_date'];
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.tteam_id like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }
        if ($searchQuery != '') { $this->db->where($searchQuery); }

        $this->db->where("user_information.parlour_name !=", "");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("tteam_id", $emp_no); 
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
        $this->db->where("user_information.parlour_name !=", "");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("tteam_id", $emp_no); 
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($from_date!=="" && $to_date!==""){
            $this->db->where('user_information.createddate >=', $from_date);
            $this->db->where('user_information.createddate <=', $to_date);
        }
        elseif($from_date!=""){
            $this->db->where('user_information.createddate >=', $from_date);
        }
        elseif($to_date!=""){
            $this->db->where('user_information.createddate <=', $to_date);
        }

        if ($searchQuery != '') { $this->db->where($searchQuery); }
        $this->db->where("user_information.parlour_name !=", "");
        $this->db->where('user_information.ct_pre_doc_upload', "uploaded");
        $this->db->where('user_information.ct_post_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where("tteam_id", $emp_no); 
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();
          

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }

            $details = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                </ul>
            </div>
        </td> ';


            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            
            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "distributor_code" => $record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "trainee" => $record->tteam_id, 
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    ## maintanance team 
    public function get_mt_approve_form($postData,$tb_name){
        
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // input filter
        $rsm = $postData['rsm'];
        $bdm = $postData['bdm'];

        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);

        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }

        $this->db->where("ct_review ", "1");
        $this->db->where('ct_pre_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where('parlour_name !=', "");
        $this->db->where('distributor_code !=', "");
        $this->db->where('mt_upload',"");
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        $totalRecords = count($records);
        
        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if ($searchQuery != '') 
        $this->db->where($searchQuery);
        $this->db->where("ct_review ", "1");

        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }
        $this->db->where('ct_pre_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where('parlour_name !=', "");
        $this->db->where('distributor_code !=', "");
        $this->db->where('mt_upload', "");
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);

        ## Fetch records
        $this->db->select('*');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
        $this->db->where($searchQuery);
        $this->db->where("ct_review ", "1");

        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }

        $this->db->where('ct_pre_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where("sh_ct_doc_approve", "Approved"); 
        $this->db->where('parlour_name !=', "");
        $this->db->where('distributor_code !=', "");
        $this->db->where('mt_upload',"");
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
            }
            else{
                $sh_doc='';
            }


            $details = ' <td>
                <div class="dropdown" >
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" style="min-width:0;">
                        <li><a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                        <li>'.$sh_doc.'</li>
                        <li><a href="#" style="width:75%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                    </ul>
                </div>
            </td> ';    

            $action='<button title="Action" type="button" class="btn btn-success" onclick="mt_approve_action('."'".$record->id."'".');"><i class="fa fa-hand-paper-o"></i></button>';

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            

            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "distributor_code" => $record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
                "action" => $action,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    
    public function get_mt_uploaded_form($postData,$tb_name){
        // $mobile = $this->session->userdata('mobile');
        
        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // input filter
        $rsm = $postData['rsm'];
        $bdm = $postData['bdm'];

        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        $this->db->where("ct_review ", "1");
        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }
        $this->db->where('ct_pre_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where('parlour_name !=', "");
        $this->db->where('distributor_code !=', "");
        $this->db->where('mt_upload !=', "");
        $this->db->group_by('user_information.id');

        $records = $this->db->get()->result();
        $totalRecords = count($records);
        
        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
        
        if ($searchQuery != '') 
        $this->db->where($searchQuery);
        $this->db->where("ct_review ", "1");
        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }
        $this->db->where('ct_pre_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where('parlour_name !=', "");
        $this->db->where('distributor_code !=', "");
        $this->db->where('mt_upload !=', "");
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);

        ## Fetch records
        $this->db->select('*');
        $this->db->from($tb_name);

        if ($searchQuery != '') 
        $this->db->where($searchQuery);
        $this->db->where("ct_review ", "1");
        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }
        $this->db->where('ct_pre_doc_upload', "uploaded");
        $this->db->where("sh_approval", "Approved"); 
        $this->db->where('parlour_name !=', "");
        $this->db->where('distributor_code !=', "");
        $this->db->where('mt_upload !=', "");
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $d_id=$record->id;
            $this->db->where('d_id', $d_id);
            $query = $this->db->get('sh_report_img');
            $get_images= $query->result();

            if (is_array($get_images) && count($get_images) > 0) {
                $sh_doc='<a href="#" style="width:80%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>
                ';
            }
            else{
                $sh_doc='';
            }

            $action = ' <td>
            <div class="dropdown" >
                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                   Action <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" style="min-width:0;">
                    <li><a href="#" style="width:80%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                    <li>'.$sh_doc.'</li>
                    <li><a href="#" style="width:80%;" class="dropdown-item pl-0" onclick="view_tt_score_details('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                    <li><a href="#" style="width:80%;" class="dropdown-item pl-0" onclick="uploaded_view_action('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image & Video</a></li>
                </ul>
            </div>
        </td> ';

            //score 
            if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
                $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
            }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
                $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
            }else{
                $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
            }

            if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
                $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
            }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
                $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
            }else{
                $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
            }

            if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
                $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
            }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
                $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
            }else{
                $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
            }

            $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
            <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
            <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
            //score

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
                <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
            
            $data[] = array(
                "id" => $record->id,
                "action" => $action,
                "name" => $record->name,
                "distributor_code" => $record->distributor_code,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "score" => $score, 
                "proof_type" => $proof_type, 
                "created_by" => $record->created_by, 
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }





  
    function get_table_row_condition($table, $col, $id) {
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        $query->row_array();
        return $query->result_array();
    }

    function insert_data($table, $data) {
        $this->db->insert($table, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    function insert_data_img($table, $data, $image = array()) {
        $this->db->insert($table, $data);
        $this->db->insert_batch($table, $image); 
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    function get_table_row_with_two_condition($table, $col, $id, $col2, $id2) {
        $this->db->where($col, $id);
        $this->db->where($col2, $id2);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    function format_mdy($date, $sub = '.') {//20.05.2021
        if (empty($date)) {
            return '';
        } else if ($date == 'Cancelled') {
            return '';
        } else {
            $d = explode($sub, $date);
            return $d[2] . '-' . $d[1] . '-' . $d[0];
        }
    }

    function get_additioanl_info($table, $parameters ) {
        $this->db->where('parameters', $parameters);
        $query = $this->db->get($table);
        return $query->result_array();
    }
   
    function get_images($table, $col, $id) { 
        $this->db->where($col, $id);
        $query = $this->db->get($table);
        return $query->result();

    }
    
    // get Zop Code
    public function getZip_code($townID) {
        $this->db->select('town_code as town_code');
        $this->db->where('town_name', $townID);
        $query = $this->db->get('towns_details');
        return $query->row_array();
    }

    public function get_population($townID) {
        $this->db->select('population as population');
        $this->db->where('town_name', $townID);
        $query = $this->db->get('towns_details');
        return $query->row_array();
    }

    // get city towns
    public function getTowns($cityID) {
        $this->db->select('*');
        $this->db->from('towns_details');
        $this->db->group_by('town_name');
        $this->db->where('district_name', $cityID);
        $this->db->order_by('town_name', 'asc');  # or desc
        $query = $this->db->get();
        return $query->result_array();
    }

     // get city method
     public function getCities($stateID) {
        $this->db->select('*');
        $this->db->from('towns_details');
        $this->db->group_by('district_name');
        $this->db->where('state_name', $stateID);
        $this->db->order_by('district_name', 'asc');  # or desc
        $query = $this->db->get();
        return $query->result_array();
    }

    // get state
    function get_state() {
        $this->db->select('*');
        $this->db->from("towns_details");
        $this->db->where("state_name !=", '');
        $this->db->group_by('state_name');
        $this->db->order_by('state_name', 'asc');  # or desc
        $query = $this->db->get();
        return $query->result_array();
    }

    // get city
    function get_city($table, $city_id) {
        $this->db->select('name as city');
        $this->db->where('id', $city_id);
        $query = $this->db->get($table);
        $query->row_array();
        //echo $this->db->last_query(); exit;
        $result = $query->row_array();
        if ($result['city']) {
            return $result['city'];
        } else {
            return 0;
        }
    }

    // get town
    function get_town($table, $town_id) {
        $this->db->select('name as town');
        $this->db->where('id', $town_id);
        $query = $this->db->get($table);
        $query->row_array();
        //echo $this->db->last_query(); exit;
        $result = $query->row_array();
        if ($result['town']) {
            return $result['town'];
        } else {
            return 0;
        }
    }

    public function get_funneled_row_data_ct($id)
    {
        $this->db->where("id",$id);
        $this->db->select('*');
        $query = $this->db->get("user_information");
        return $query->result_array();
    }	
 
    public function get_funneled_row_data($id)
    {
        $this->db->where("id",$id);
        $this->db->select('*');
        $query = $this->db->get("user_information");
        return $query->result();
    }	
       

    public function get_state_row($name)
    {
        $this->db->where("name",$name);
        $this->db->select('*');
        $query = $this->db->get("states");
        return $query->result();
    }

    public function get_city_row($name)
    {
        $this->db->where("name",$name);
        $this->db->select('*');
        $query = $this->db->get("cities");
        return $query->result();
    }
        

    public function get_city_set($id)
    {
        $this->db->where("state_id",$id);
        $this->db->select('*');
        $query = $this->db->get("cities");
        return $query->result();
    }

    public function get_town_set($id)
    {
        $this->db->where("city_id",$id);
        $this->db->select('*');
        $query = $this->db->get("towns");
        return $query->result();
    }


    public function get_states()
    {
        $this->db->select('*');
        $query = $this->db->get("states");
        return $query->result();
    }

    public function get_location($id,$db_id,$table_name)
    {
        $this->db->where($db_id,$id);
        $this->db->select('*');
        $query = $this->db->get($table_name);
        return $query->result();
    }

    public function get_image($id,$db_id,$table_name)
    {
        $this->db->where($db_id,$id);
        $this->db->select('*');
        $query = $this->db->get($table_name);
        return $query->result();
    }

    public function insert_locations($save_data,$table){
        return $this->db->insert($table, $save_data);
    }

    public function get_location_table_rep($postData,$tb_name){

        $user = $this->session->userdata('emp_no');
        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            c_shopname like '%" . $searchValue . "%' or 
            address like '%" . $searchValue . "%' or 
            morning like '%" . $searchValue . "%' or 
            afternoon like '%" . $searchValue . "%' or 
            evening like '%" . $searchValue . "%' or 
            area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.allocated_person !=","");
        $this->db->where("locations.allocated_person ",$user);
        $this->db->group_start() ;
        $this->db->where("locations.morning","");
        $this->db->or_where("locations.afternoon","");
        $this->db->or_where("locations.evening","");
        $this->db->or_where("locations.morn_review_image","");
        $this->db->or_where("locations.after_review_image","");
        $this->db->or_where("locations.even_review_image","");
        $this->db->order_by("locations.evening ",'desc');
        $this->db->group_end() ;
        if ($searchQuery != '') {   $this->db->where($searchQuery); }
        $records = $this->db->get()->result();

        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.allocated_person !=","");
        $this->db->where("locations.allocated_person ",$user);
        $this->db->group_start() ;
        $this->db->where("locations.morning","");
        $this->db->or_where("locations.afternoon","");
        $this->db->or_where("locations.evening","");
        $this->db->or_where("locations.morn_review_image","");
        $this->db->or_where("locations.after_review_image","");
        $this->db->or_where("locations.even_review_image","");
        $this->db->order_by("locations.evening ",'desc');
        $this->db->group_end() ;

        if ($searchQuery != '') {   $this->db->where($searchQuery); }
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.allocated_person !=","");
        $this->db->where("locations.allocated_person ",$user);
        $this->db->group_start() ;
        $this->db->where("locations.morning","");
        $this->db->or_where("locations.afternoon","");
        $this->db->or_where("locations.evening","");
        $this->db->or_where("locations.morn_review_image","");
        $this->db->or_where("locations.after_review_image","");
        $this->db->or_where("locations.even_review_image","");
        $this->db->order_by("locations.evening ",'desc');
        $this->db->group_end() ;

       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array(); 

        foreach ($records as $record)
        {	
            $img ='<a target="blank" href="../../uploads/place_review_image/'.$record->place_review_image.'"><img src="../../uploads/place_review_image/'.$record->place_review_image.'" width="90" class="img-thumbnail" height="55"/>';
            $action = '
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"   onclick="edit_location('."'".$record->id."'".')">Place Review</button>';

            $schedule = '<td><div class="row"><div class="col-10 p-1 text-dark" id="mor"><b>Morning &nbsp; &nbsp;:</b><span class="float-center text-white"> '.$record->morning.'</span></div></div><br>
            <div class="row"><div class="col-10 p-1 text-dark" id="aft"><b>Afternoon :</b><span class="float-center text-white"> '.$record->afternoon.'</span></div></div> <br> 
            <div class="row"><div class="col-10 p-1 text-dark" id="even"><b>Evening &nbsp; &nbsp;&nbsp;:</b><span class="float-center text-white"> '.$record->evening.'</span></div></div></td>';

                $data[] = array(
                    "id" => $record->id,
                    "img" => $img,
                    "state_name" => $record->state_name,
                    "city_name" => $record->city_name,
                    "town_name" => $record->town_name,
                    "area" => $record->area,
                    "c_shopname" => $record->c_shopname,
                    "address" => $record->address,
                    "time_schedul" => $schedule,
                    "morning" => $record->morning,
                    "afternoon" => $record->afternoon,
                    "evening" => $record->evening,
                    "action" => $action,
                );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }
  

    public function update_locations($table,$id_db,$id,$data)
    {
        $this->db->where("$id_db", $id);
        $this->db->update("$table", $data);
        return $id;
        //  return $this->db->update("$table", $data);
    }

    public function get_location_table($postData,$tb_name){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            c_shopname like '%" . $searchValue . "%' or 
            address like '%" . $searchValue . "%' or 
            area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $records = $this->db->get()->result();
        
        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
          }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array();

        foreach ($records as $record)
        {	
            $action = '
            <button class="btn btn-primary" title="Edit" onclick="edit_location('."'".$record->id."'".')"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger" title="Delete" onclick="delete_location('."'".$record->id."'".')"><i class="fa fa-trash"></i></button>';

            $allocate_act = '<button class="btn btn-primary btn-mini " onclick="allocate_locate('."'".$record->id."'".');">
            <i class="fa fa-pencil"></i></button>   ';
            
            $data[] = array(
                "id" => $record->id,
                "state_name" => $record->state_name,
                "city_name" => $record->city_name,
                "town_name" => $record->town_name,
                "area" => $record->area,
                "c_shopname" => $record->c_shopname,
                "address" => $record->address,
                "action" => $action,
                "allocate_act" => $allocate_act,
                "allocated_person" => $record->allocated_person,
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    public function get_allocate_locations($postData,$tb_name ,$col ,$val){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            c_shopname like '%" . $searchValue . "%' or 
            address like '%" . $searchValue . "%' or 
            area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.$col","$val");
        $records = $this->db->get()->result();
        
        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.$col","$val");
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.$col","$val");
       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
          }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array();

        foreach ($records as $record)
        {	
            $action = '
            <button class="btn btn-primary" title="Edit" onclick="edit_location('."'".$record->id."'".')"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger" title="Delete" onclick="delete_location('."'".$record->id."'".')"><i class="fa fa-trash"></i></button>';

            $allocate_act = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal" title="Allocate" onclick="allocate_locate('."'".$record->id."'".','."'".$record->c_shopname."'".')">
            <i class="fa fa-hand-paper-o"></i></button>';
            
            $data[] = array(
                "id" => $record->id,
                "state_name" => $record->state_name,
                "city_name" => $record->city_name,
                "town_name" => $record->town_name,
                "area" => $record->area,
                "c_shopname" => $record->c_shopname,
                "address" => $record->address,
                "action" => $action,
                "allocate_act" => $allocate_act,
                "allocated_person" => $record->allocated_person,
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    public function get_allocated_locations($postData,$tb_name){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            locations.c_shopname like '%" . $searchValue . "%' or 
            locations.address like '%" . $searchValue . "%' or 
            users.username like '%" . $searchValue . "%' or 
            locations.area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name ,users.username as users");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->join('users', "users.emp_no = locations.allocated_person");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.allocated_person !=","");
        $records = $this->db->get()->result();
        
        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->join('users', "users.emp_no = locations.allocated_person");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.allocated_person !=","");
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name ,users.username as users");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->join('users', "users.emp_no = locations.allocated_person");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.allocated_person !=","");
       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
          }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array();

        foreach ($records as $record)
        {	
            $action = '
            <button class="btn btn-primary" title="Edit" onclick="edit_location('."'".$record->id."'".')"><i class="fa fa-edit"></i></button>&nbsp;<button class="btn btn-danger" title="Delete" onclick="delete_location('."'".$record->id."'".')"><i class="fa fa-trash"></i></button>';

            $allocate_act = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal"   onclick="allocate_locate('."'".$record->id."'".','."'".$record->c_shopname."'".')">
            <i class="fa fa-hand-paper-o"></i></button>';
            
            if($record->allocated_person !=""){
                $rsp =$record->allocated_person;
                $this->db->where('emp_no', $rsp);
                $query = $this->db->get('users');
                $get_images= $query->result();
    
                $allocated_person = $get_images[0]->username;
            }else{ 
                $allocated_person ="";
            }
            $data[] = array(
                "id" => $record->id,
                "state_name" => $record->state_name,
                "city_name" => $record->city_name,
                "town_name" => $record->town_name,
                "area" => $record->area,
                "c_shopname" => $record->c_shopname,
                "address" => $record->address,
                "allocated_person" => $allocated_person,
            );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    public function get_completed_location($postData,$tb_name , $col,$val ){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            c_shopname like '%" . $searchValue . "%' or 
            address like '%" . $searchValue . "%' or 
            area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.morn_review_image !=","");
        $this->db->where("locations.after_review_image !=","");
        $this->db->where("locations.even_review_image !=","");
        $this->db->where("locations.$col","$val");
        $this->db->order_by("locations.evening ",'desc');
        $records = $this->db->get()->result();
        
        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.morn_review_image !=","");
        $this->db->where("locations.after_review_image !=","");
        $this->db->where("locations.even_review_image !=","");
        $this->db->where("locations.$col","$val");
        $this->db->order_by("locations.evening ",'desc');
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.morn_review_image !=","");
        $this->db->where("locations.after_review_image !=","");
        $this->db->where("locations.even_review_image !=","");
        $this->db->where("locations.$col","$val");
        $this->db->order_by("locations.evening ",'desc');
       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
          }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array();

        foreach ($records as $record) 
        {	

            $img= '<button class="btn btn-warning" data-toggle="modal" data-target="#myModalview"   onclick="get_image('."'".$record->id."'".')">View</button>';
            $action = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="get_id('."'".$record->id."'".')"><i class="fa fa-hand-paper-o"></i></button>';
            $view = '<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="get_id('."'".$record->id."'".')"><i class="fa fa-eye"></i></button>';
            
            $schedule = '<td><div class="row"><div class="col-10 p-1 text-dark" id="mor"><b>Morning &nbsp; &nbsp;:</b><span class="float-center text-white"> '.$record->morning.'</span></div></div><br>
            <div class="row"><div class="col-10 p-1 text-dark" id="aft"><b>Afternoon :</b><span class="float-center text-white"> '.$record->afternoon.'</span></div></div> <br> 
            <div class="row"><div class="col-10 p-1 text-dark" id="even"><b>Evening &nbsp; &nbsp;&nbsp;:</b><span class="float-center text-white"> '.$record->evening.'</span></div></div></td>';

            $remarks = '<td><div class="row"><div class="col-10 p-1">OM Remark :<span class="float-center text-green"> '.$record->om_remark.'</span></div></div>
            <div class="row"><div class="col-10 p-1">RSM Remark :<span class="float-center text-green"> '.$record->rsm_loc_remark.'</span></div></div>
            <div class="row"><div class="col-10 p-1">Idhaya Remark :<span class="float-center text-green"> '.$record->idhaya_remark.'</span></div></div></td>';


                $data[] = array(
                    "id" => $record->id,
                    "state_name" => $record->state_name,
                    "city_name" => $record->city_name,
                    "town_name" => $record->town_name,
                    "area" => $record->area,
                    "c_shopname" => $record->c_shopname,
                    "address" => $record->address,
                    "time_schedul" => $schedule,
                    "review_date" => $record->review_date,
                    "updated_at" => $record->updated_at,
                    "remarks" => $remarks,
                    "img" => $img,
                    "action" => $action,
                    "view" => $view,
                );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    public function get__approved_location($postData,$tb_name , $col,$val ,$array){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            c_shopname like '%" . $searchValue . "%' or 
            address like '%" . $searchValue . "%' or 
            area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.morn_review_image !=","");
        $this->db->where("locations.after_review_image !=","");
        $this->db->where("locations.even_review_image !=","");
        $this->db->where("locations.$col","$val");
        $this->db->where($array);
        $this->db->order_by("locations.evening ",'desc');
        $records = $this->db->get()->result();
        
        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        if ($searchQuery != '') {   $this->db->where($searchQuery); }

        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.morn_review_image !=","");
        $this->db->where("locations.after_review_image !=","");
        $this->db->where("locations.even_review_image !=","");
        $this->db->where("locations.$col","$val");
        $this->db->where($array);
        $this->db->order_by("locations.evening ",'desc');
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.morn_review_image !=","");
        $this->db->where("locations.after_review_image !=","");
        $this->db->where("locations.even_review_image !=","");
        $this->db->where("locations.$col","$val");
        $this->db->where($array);
        $this->db->order_by("locations.evening ",'desc');
       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
          }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array();

        foreach ($records as $record)
        {	

            $img= '<button class="btn btn-warning" data-toggle="modal" data-target="#myModalview" title="View"  onclick="get_image('."'".$record->id."'".')">View</button>';
            $action = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="get_id('."'".$record->id."'".')"><i class="fa fa-hand-paper-o"></i></button>';
            
            $schedule = '<td><div class="row"><div class="col-10 p-1 text-dark" id="mor"><b>Morning &nbsp; &nbsp;:</b><span class="float-center text-white"> '.$record->morning.'</span></div></div><br>
            <div class="row"><div class="col-10 p-1 text-dark" id="aft"><b>Afternoon :</b><span class="float-center text-white"> '.$record->afternoon.'</span></div></div> <br> 
            <div class="row"><div class="col-10 p-1 text-dark" id="even"><b>Evening &nbsp; &nbsp;&nbsp;:</b><span class="float-center text-white"> '.$record->evening.'</span></div></div></td>';

                $data[] = array(
                    "id" => $record->id,
                    "state_name" => $record->state_name,
                    "city_name" => $record->city_name,
                    "town_name" => $record->town_name,
                    "area" => $record->area,
                    "c_shopname" => $record->c_shopname,
                    "address" => $record->address,
                    "time_schedul" => $schedule,
                    "review_date" => $record->review_date,
                    "img" => $img,
                    "action" => $action,
                );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }
    
    public function get_future_prospects($postData,$tb_name){

        $response = array();
        ## Read value
        $draw = $postData['draw']; 
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        
        ## Search
        $search_arr = array();
        $searchQuery = "";

        if ($searchValue != '')
        {
            $search_arr[] = " (
            c_shopname like '%" . $searchValue . "%' or 
            address like '%" . $searchValue . "%' or 
            area like '%" . $searchValue . "%' ) ";
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }

        ## Total number of records without filtering
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.approval_locations","Rejected");
        $this->db->order_by("locations.evening ",'desc');
        $records = $this->db->get()->result();
        
        $totalRecords = count($records);

        ## Total number of record with filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.approval_locations","Rejected");
        $this->db->order_by("locations.evening ",'desc');
        $records = $this->db->get()->result();

        $totalRecordwithFilter =  $records[0]->allcount;

        ## Fetch records

        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","Active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $this->db->where("locations.approval_locations","Rejected");
        $this->db->order_by("locations.evening ",'desc');
       
        if ($searchQuery != '') {
            $this->db->where($searchQuery);
          }
          $this->db->limit($rowperpage, $start);
          $records = $this->db->get()->result();
          $data = array();

        foreach ($records as $record)
        {	

           $img= '<button class="btn btn-warning" data-toggle="modal" data-target="#myModalview"   onclick="get_image('."'".$record->id."'".')">View</button>';
                                                           
            $action = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal"   onclick="get_id('."'".$record->id."'".')"><i class="fa fa-hand-paper-o"></i></button>';

            $schedule = '<td><div class="row"><div class="col-10 p-1 text-dark" id="mor"><b>Morning &nbsp; &nbsp;:</b><span class="float-center text-white"> '.$record->morning.'</span></div></div><br>
            <div class="row"><div class="col-10 p-1 text-dark" id="aft"><b>Afternoon :</b><span class="float-center text-white"> '.$record->afternoon.'</span></div></div> <br> 
            <div class="row"><div class="col-10 p-1 text-dark" id="even"><b>Evening &nbsp; &nbsp;&nbsp;:</b><span class="float-center text-white"> '.$record->evening.'</span></div></div></td>';


                $data[] = array(
                    "id" => $record->id,
                    "state_name" => $record->state_name,
                    "city_name" => $record->city_name,
                    "town_name" => $record->town_name,
                    "area" => $record->area,
                    "c_shopname" => $record->c_shopname,
                    "address" => $record->address,
                    "time_schedul" => $schedule,
                    "morning" => $record->morning,
                    "afternoon" => $record->afternoon,
                    "evening" => $record->evening,
                    "updated_at" => $record->updated_at,
                    "img" => $img,
                    "action" => $action,
                );
        }
        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }


    public function get_completed_shop_table_ct(){
        $this->db->select("locations.*,states.name as state_name,cities.name as city_name,towns.name as town_name");
        $this->db->from('locations');
        $this->db->join('towns', "towns.id = locations.town_id");
        $this->db->join('cities', "towns.city_id = cities.id");
        $this->db->join('states', "states.id = cities.state_id");
        $this->db->where("locations.status","active");
        $this->db->where("locations.morning !=","");
        $this->db->where("locations.afternoon !=","");
        $this->db->where("locations.evening !=","");
        $query = $this->db->get();
        return $query->result();
    }


    public function total_count_d($table) {
        $this->db->where('role', 'MP');
        $query = $this->db->get('users')->result();
      
        foreach($query as $query){
           
            $this->db->select('*');
            $this->db->from($table);
            $this->db->distinct();
            $this->db->where('status =','Saved');

            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;

            $records = $this->db->get()->num_rows();
            return $records;
        }
        // return $records;
    }

    public function total_count_ed($table) {
        $this->db->where('role', 'MP');
        $query = $this->db->get('users')->result();

        foreach($query as $query){
            $this->db->select('*');
            $this->db->from($table);
            $this->db->distinct();
            $this->db->where('status =','1');

            $this->db->group_start() ;
            $this->db->where('created_by =', $query->emp_no);
            $this->db->or_where('created_by =',"Customer");
            $this->db->group_end() ;

            $records = $this->db->get()->num_rows();
            return $records;
        }
        // return $records;
    }


    public function total_count($array,$table) {
        $this->db->where($array);
        $this->db->select('*');
        $records = $this->db->get($table);
        $result = $records->num_rows();
        return $result;
    }
    
    public function total_count1($array,$table) {
        $this->db->where("created_by !=","Customer" );
        $this->db->where($array);
        $this->db->select('*');
        $records = $this->db->get($table);
        $result = $records->num_rows();
        return $result;
    }

    public function total_count2($array,$table,$col){
        $this->db->where($array);
        $this->db->where("$col !=" ,"");
        $this->db->select('*');
        $records = $this->db->get($table);
        $result = $records->num_rows();
        return $result;
    }

    function rsm_filter_count($col1 ,$val1 ,$col2 ,$val2) {
        $user = $this->session->userdata('emp_no');
        $this->db->select("user_information.*");
        $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
        $this->db->where('masters.RSM_emp_no', $user);
        $this->db->where("user_information.$col2",$val2);
        $this->db->where("user_information.$col1",$val1);
        $records = $this->db->get('user_information');
        $result = $records->num_rows();
        return $result;
    } 

    public function total_count_rep($array,$table,$col){
        $this->db->select('*');
        $this->db->where($array);
        // $this->db->where("$col !=" ,"");
        $this->db->group_start() ;
        $this->db->where("locations.morning","");
        $this->db->or_where("locations.afternoon","");
        $this->db->or_where("locations.evening","");
        $this->db->or_where("locations.morn_review_image","");
        $this->db->or_where("locations.after_review_image","");
        $this->db->or_where("locations.even_review_image","");
        $this->db->group_end() ;
        $records = $this->db->get($table);
        $result = $records->num_rows();
        return $result;
    }

    public function total_count_rep2($array,$table){
        $this->db->select('*');
        $this->db->where($array);
        $this->db->where("status","Active");
        $this->db->where("morning !=","");
        $this->db->where("afternoon !=","");
        $this->db->where("evening !=","");
        $this->db->where("morn_review_image !=","");
        $this->db->where("after_review_image !=","");
        $this->db->where("even_review_image !=","");
        $records = $this->db->get($table);
        $result = $records->num_rows();
        return $result;
    }
 

    public function completed_location_count($array,$table){
        $this->db->where($array);
        $this->db->where("morning !=" ,"");
        $this->db->where("afternoon !=" ,"");
        $this->db->where("evening !=" ,"");
        $this->db->select('*');
        $records = $this->db->get($table);
        $result = $records->num_rows();
        return $result;
    }

    function DISTINCT_table($col, $table) {
        $this->db->select($col);
        $this->db->distinct();
        $query = $this->db->get($table);
        return $query->result_array();
    }

    function DISTINCT_table2($table ,$col1,$col2 ,$emp_no) {
        $this->db->select($col1);
        $this->db->select($col2);
        $this->db->where('RSM_emp_no' ,$emp_no);
        $this->db->distinct();
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function get_approved_list_idhaya_log($postData,$tb_name ,$array){
        $emp_no = $this->session->userdata('emp_no');

        $response = array();
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
        // month filter
        $rsm = $postData['rsm'];
        $bdm = $postData['bdm'];
        ## Search
        $search_arr = array();
        $searchQuery = "";
        if ($searchValue != '')
        {
            $search_arr[] = " (user_information.name like '%" . $searchValue . "%' or 
            user_information.mobile like '%" . $searchValue . "%' or 
            user_information.tteam_id like '%" . $searchValue . "%' or 
            user_information.shop_address like '%" . $searchValue . "%' )"; 
        }

        if (count($search_arr) > 0)
        {
            $searchQuery = implode(" and ", $search_arr);
        }
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);

        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }
        if ($searchQuery != '') { $this->db->where($searchQuery); }
        
        $this->db->where($array);
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        $totalRecords = count($records); 
        // $totalRecords = $records[0]->allcount; 

        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        $this->db->from($tb_name);
      
        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }

        if ($searchQuery != '') {
            $this->db->where($searchQuery);
        }

        $this->db->where($array);
        $this->db->group_by('user_information.id');
        $records = $this->db->get()->result();
        
        $totalRecordwithFilter = count($records);
        // $totalRecordwithFilter = $records[0]->allcount;

        ## Fetch records
        $this->db->select('user_information.*');
        $this->db->from($tb_name);
        
        if($rsm != ''){
            $this->db->join('masters', 'masters.BDM_emp_no = user_information.updated_by');
            $this->db->where("masters.RSM_name ", $rsm);
        }
        if($bdm !=""){
            $this->db->where("masters.RSM_name ", $rsm);
            $this->db->where("masters.BDM_name", $bdm);
        }

        if ($searchQuery != '') { $this->db->where($searchQuery); }
        $this->db->where($array);
        $this->db->group_by('user_information.id');
        $this->db->order_by('user_information.id', 'asc');  # or desc

        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();

        $data = array();

        foreach ($records as $record)
        {	

            $proof_type='<span>Proof Type :</span><b class="text-success">'.$record->proof_type.'</b> <br>
            <span>'.$record->proof_type.' No :</span><b class="text-success">'.$record->proof_no.'</b>';
       

        if($record->sh_approval == "Approved"){
            $approve='<b class="text-success">Approved</b>';
        }elseif($record->sh_approval == "Rejected"){
            $approve='<b class="text-danger">Hold</b>';
        }else{
            $approve='<b class="text-warning">Pending</b>';
        } 

        if($record->distributor_code != ""){
            $cc_approve='<b class="text-success">Completed</b>';
        }elseif($record->ct_post_doc_upload == "uploaded" && $record->ct_pre_doc_upload == "uploaded"){
            $cc_approve='<b class="text-success">Approved</b>';
        }else{
            $cc_approve='<b class="text-warning">Pending</b>';
        } 

        $approval = '<span>SH :</span><b>'.$approve.'</b><br>
        <span>FCC :</span><b class="text-success">'.$cc_approve.'</b>' ;


        $img_view='<td><button type="button" class="btn btn-primary" >View</button></td>';
        $detail_view='<td><button type="button" class="btn btn-primary" >View</button></td>';
       
        //score 
        if( ($record->bd_score >="80") && ($record->bd_score <="100") ){
            $bd_score='<b class="text-white bg-success p-1">'.$record->bd_score.'</b>';
        }elseif( ($record->bd_score >="50") && ($record->bd_score <"80")){
            $bd_score='<b class="text-white bg-warning p-1">'.$record->bd_score.'</b>';
        }else{
            $bd_score='<b class="text-white bg-danger p-1">'.$record->bd_score.'</b>';
        }

        if( ($record->frc_score >="80") && ($record->frc_score <="100") ){
            $frc_score='<b class="text-white bg-success p-1">'.$record->frc_score.'</b>';
        }elseif( ($record->frc_score >="50") && ($record->frc_score <"80")){
            $frc_score='<b class="text-white bg-warning p-1">'.$record->frc_score.'</b>';
        }else{
            $frc_score='<b class="text-white bg-danger p-1">'.$record->frc_score.'</b>';
        }

        if( ($record->ct_score >="80") && ($record->ct_score <="100") ){
            $ct_score='<b class="text-white bg-success p-1">'.$record->ct_score.'</b>';
        }elseif( ($record->ct_score >="50") && ($record->ct_score <"80")){
            $ct_score='<b class="text-white bg-warning p-1">'.$record->ct_score.'</b>';
        }else{
            $ct_score='<b class="text-white bg-danger p-1">'.$record->ct_score.'</b>';
        }

        $score='<div class="row">&nbsp;&nbsp;<span>BD Score &nbsp;&nbsp;:</span><b>&nbsp;'.$bd_score.'</b> </div><br>
        <div class="row">&nbsp;&nbsp;<span>FRC Score :</span><b>&nbsp;'.$frc_score.'</b></div><br>
        <div class="row">&nbsp;&nbsp;<span>CT Score  &nbsp;&nbsp;:</span><b>&nbsp;'.$ct_score.'</b></div><br>';
        //score


        $d_id=$record->id;
        $this->db->where('d_id', $d_id);
        $query = $this->db->get('sh_report_img');
        $get_images= $query->result();


        if (is_array($get_images) && count($get_images) > 0) {
            $sh_doc='<a href="#" style="width:75%;" class="dropdown-item  pl-0"onclick="view_sh_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;SH DOC</a>';
        }
        else{
            $sh_doc='';
        }

        $details = ' <td>
                <div class="dropdown" >
                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    Action <span class="caret"></span>
                    </button> 
                    <ul class="dropdown-menu" style="min-width:0;">
                        <li><a href="#" style="width:70%;" class="dropdown-item  pl-0"onclick="view_image('."'".$record->id."'".');"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                        <li>'.$sh_doc.'</li>
                        <li><a href="#" style="width:70%;" class="dropdown-item pl-0" onclick="view_doc_detail('."'".$record->id."'".');"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                    </ul>
                </div>
            </td> ';

            $action ='<td><button type="button" class="btn btn-success" onclick="approve_action('."'".$record->id."'".');" ><i class="fa fa-hand-paper-o"</i></button></td>';
            
            if($record->ct_review=="1"){
                $ct_review='<b class="text-success">CT Verified</b>';
            }
            else{
                $ct_review='';
            }

            $data[] = array(
                "id" => $record->id,
                "details" => $details,
                "name" => $record->name,
                "mobile" => $record->mobile,
                "shop_address" => $record->shop_address,
                "town_code" => $record->town_code,
                "score" => $score,
                "proof_type" => $proof_type,
                "approval" => $approval,
                "action" => $action,
                "ct_verify" => $ct_review,
                "created_by" => $record->created_by,
            );
        }

        ## Response
        $response = array(
            "draw" => intval($draw) ,
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return $response;
    }

    function get_bdm($col, $rsm, $table) {
        $this->db->where('RSM_name', $rsm);
        $this->db->group_by('BDM_name');
        $query = $this->db->get($table);
        return $query->result_array();
    }

}
