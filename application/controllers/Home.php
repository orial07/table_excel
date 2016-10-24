<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	   public function __construct()
        {
                parent::__construct();

                $this->load->library('session');
                $this->load->helper('security');
                $this->load->helper('url');
                $this ->load-> library('form_validation');
                }

	public function index()
	{    
    if($this->session->userdata('logged_in'))
      $this->table();
    else{
		$this->load->view("welcome");
  }

	}



  public function demo()
  {    
    if($this->session->userdata('logged_in'))
      $this->table();
    else{
    $this->load->view("demo_table");
  }

  }



    
  public function login()
  {   

      if($this->session->userdata('logged_in'))
         $this->table();

else{

        $this -> form_validation -> set_rules('email','Email','required|valid_email|trim|min_length[5]|xss_clean');
        $this -> form_validation -> set_rules('pass','Password','required|trim|min_length[5]|xss_clean');
       if ($this -> form_validation -> run() == FALSE) {
         $data['login_errors'] = validation_errors();
        $this->load->view("welcome",$data);
      } 
    else {
         $email= $this -> input -> post('email');
         $pass= md5($this -> input -> post('pass'));
         $this->load->model('table_model');

        if( $data=$this->table_model->get_user($pass,$email))
        {
             $newdata = array(
         'id_user' =>  $data['id_user'],
        'name'  => $data['name'],
        'email'     => $data['email'],
        'logged_in' => TRUE
                  );
        $this->session->set_userdata($newdata);
        $this->table();
      }
       else
       {
        $data['credintials']="Your credintials were not right.Please give the correct E-mail and Password ";
           $this->load->view("welcome",$data);
     
        
       }
  }
}

}


public function register(){
         
         if($this->session->userdata('logged_in'))
         $this->table();

else{
        $this->load->model('table_model');
        $this -> load -> library('form_validation');
        $this -> form_validation -> set_rules('email','Email','required|valid_email|trim|is_unique[users.email]');
        $this -> form_validation -> set_rules('pass','Password','required|trim|min_length[5]|xss_clean');
        $this -> form_validation -> set_rules('name','Full Name','required|min_length[5]|xss_clean');
       if ($this -> form_validation -> run() == FALSE) {
        $data['register_errors'] = validation_errors();
        $this->load->view("welcome",$data);
      } 
    else {
     $a=array(
         "email"=> $this -> input -> post('email'),
         "password" => md5($this -> input -> post('pass')),
         "name" => $this -> input -> post('name'),
         );

        $this->load->model('table_model');
       if($this->table_model->insert_user($a))
         $data['register']="You are now register successfully. Please Login";
           $this->load->view("welcome",$data);


}}
}




public function table()
  {    
      if($this->session->userdata('logged_in'))
      $this->load->view("create_table");

     else redirect(site_url('/'));

  }

  public function save()
    {
      if($this->session->userdata('logged_in'))
    {
 
  if($_POST['action']=='print'){
    $this->send('print');
  }
  else if($_POST['action']=='send'){
    $this->send('download');
  }
else{
   $arr1 =$this->input->post('row');
   $arr2 =$this->input->post('column');
   $arr3 =$this->input->post('field');
   $arr4 =$this->input->post('fname');
   $arr5 =$this->input->post('ftext');
   
     if(empty($arr4) && empty($arr5))
   { 
      $table=array(
     "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $this->input->post('name'),
     "rows"=>implode(",,",$arr1),
     "columns"=>implode(",,",$arr2),
     "fields"=>implode(",,",$arr3),
     "fname"=>'Field Name',
     "ftext"=>'Description',
     
   );
   }
   elseif (empty($arr5)) {
      $table=array(
     "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $this->input->post('name'),
     "rows"=>implode(",,",$arr1),
     "columns"=>implode(",,",$arr2),
     "fields"=>implode(",,",$arr3),
     "fname"=>implode(",,",$arr4),
     "ftext"=>implode(",,",$arr5),
    
   );
   }
   else{
     $table=array(
     "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $this->input->post('name'),
     "rows"=>implode(",,",$arr1),
     "columns"=>implode(",,",$arr2),
     "fields"=>implode(",,",$arr3),
     "fname"=>implode(",,",$arr4),
     "ftext"=>implode(",,",$arr5),
     );

   }

   $this->load->model('table_model');
   if($this->table_model->insert_table($table))
    $this->show_tables();
}}
   else redirect(site_url('/'));
}

public function show_tables(){
   if($this->session->userdata('logged_in')){
  $this->load->model('table_model');
   if($a['tables']=$this->table_model->get_tables($this->session->userdata('id_user')))
   $this->load->view('show_tables',$a);
 else
 $this->load->view('no_table');
  
}
else redirect(site_url('/'));

}

public function logout(){
    if($this->session->userdata('logged_in'))
     { $this->session->sess_destroy();
      
   }
   redirect(site_url('/'));
}


private function pdf($html,$do)
{


  $this->load->library('Pdf');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Orial Mehmeti');
$pdf->SetTitle('Table');
//$pdf->SetSubject();
$pdf->SetKeywords('send, PDF, table, create, print');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// output the HTML content
$pdf->writeHTML($html, true, false, false, false, '');

  if($do=='download')
  $newFile=$pdf->Output('table.pdf', 'D');
else
   $newFile=$pdf->Output('table.pdf', 'I');

  /* Locally emails do now work, so I use this to connect through my gmail account to send emails
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'sidorilhoxha@gmail.com',
        'smtp_pass' => '',
        'mailtype'  => 'html', 
        'charset'   => 'iso-8859-1'
    );
 $this->load->library('email');
 $this->email->from('noreply@example.com', 'Example');
 $this->email->to('orial.mehmeti@gmail.com');
 $this->email->subject('Subject Goes Here');
 $this->email->message('Message goes here');
 //$this->email->attach($newFile);
 $this->email->send();

*/

}



public function email(){
   $this->load->library('email');
 $this->email->from('noreply@example.com', 'Example');
 $this->email->to('orial.mehmeti@gmail.com');
 $this->email->subject('Subject Goes Here');
 $this->email->message('Message goes here');
 //$this->email->attach($newFile);
 $this->email->send();

}




public function edit(){
 if($this->session->userdata('logged_in'))
     { 
    if($_POST['action']=='Delete'){
      $id=$this->input->post('table_id');
     $this->load->model('table_model');
   if($this->table_model->delete($id))
  $this->show_tables();
    }

    else{
$id=$this->input->post('table_id');
 $this->load->model('table_model');
   if($data['table']=$this->table_model->get_table($this->session->userdata('id_user'),$id))
   $this->load->view('edit_table',$data);
}}
else redirect(site_url('/'));
}





public function update()
    {
       if($this->session->userdata('logged_in'))
    {
 
  if($_POST['action']=='print'){
    $this->send('print');
  }
  else if($_POST['action']=='send'){
    $this->send('download');
  }
  else
  {
   $arr1 =$this->input->post('row');
   $arr2 =$this->input->post('column');
   $arr3 =$this->input->post('field');
   $arr4 =$this->input->post('fname');
   $arr5 =$this->input->post('ftext');
   
  if(empty($arr4) && empty($arr5))
   { 
      $table=array(
     "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $this->input->post('name'),
     "rows"=>implode(",,",$arr1),
     "columns"=>implode(",,",$arr2),
     "fields"=>implode(",,",$arr3),
     "fname"=>'Field Name',
     "ftext"=>'Description',
     
   );
   }
   elseif (empty($arr5)) {
      $table=array(
     "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $this->input->post('name'),
     "rows"=>implode(",,",$arr1),
     "columns"=>implode(",,",$arr2),
     "fields"=>implode(",,",$arr3),
     "fname"=>implode(",,",$arr4),
     "ftext"=>implode(",,",$arr5),
    
   );
   }
   else{
     $table=array(
     "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $this->input->post('name'),
     "rows"=>implode(",,",$arr1),
     "columns"=>implode(",,",$arr2),
     "fields"=>implode(",,",$arr3),
     "fname"=>implode(",,",$arr4),
     "ftext"=>implode(",,",$arr5),
     );

   }

   $this->load->model('table_model');
   $this->table_model->update($table, $this->input->post('tb_id'));
    $this->show_tables();
}}
   else redirect(site_url('/'));
}


public function send($pd){
  $this->load->library('table');
$row=$this->input->post('row');
   $col=$this->input->post('column');
   array_unshift ($col," ");
   $fi =$this->input->post('field');
  $fname=$this->input->post('fname');
   $ftext=$this->input->post('ftext');
 

$this->table->set_heading($col);
 $t=0;  $a=array();$k=0;
     for($i=0;$i<count($row);$i++)
       {  
          $a[$t]=nl2br($row[$i]);
            $t++;
           for($j=0;$j<count($col)-1;$j++)
          { $a[$t]=nl2br($fi[$k]);
           $k++;$t++;
          }
}
          


$new_list = $this->table->make_columns($a, count($col));
$tmpl = array (
                    'table_open'          => '<table border="1" cellpadding="2" cellspacing="1" align="center">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

$this->table->set_template($tmpl);
$c=$this->table->generate($new_list);
$ff="";
 
 if(!empty($ftext) && !empty($ftext)){
for($i=0;$i<count($fname);$i++)
  $ff.='<h3>'.$fname[$i].':'.$ftext[$i].'</h3> <br>';

$html= $ff. '<br> '.$c;
}
else
$html=$c;

$this->pdf($html,$pd);

}

function uploadTable (){
  $this->load->view('dropedz');
}

function upload(){

      $this->load->library('excel');  

    $config['upload_path'] = './docs/'; 
   $config['allowed_types'] = 'xlsx|csv|xls|ods';
    $config['max_size'] = '10000'; 
    $config['overwrite'] = true;
    $config['encrypt_name'] = FALSE;
    $config['remove_spaces'] = TRUE;

    $this->load->library('upload', $config);
    

    if ( ! $this->upload->do_upload())
    {
      $error = array('error' => $this->upload->display_errors());

    print_r($error);
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
   $this->excel( $data['upload_data']['file_name']);
    }


    


        
    }

	//private method to create an excel file with the table created by the user 
	private function excel( $filename ){

		//load our new PHPExcel library
			$this->load->library('excel');
		        $file = './docs/'.$filename;
			//load the excel library
				$this->load->library('excel');
		//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
//get only the Cell Collection
$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
//extract to a PHP readable array format

foreach ($cell_collection as $cell) {

    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
    //header will/should be in row 1 only. of course this can be modified to suit your need.
    if ($row == 1) {
        $header[$row][$column] = $data_value;
    } else {
      $colIndex = PHPExcel_Cell::columnIndexFromString($column)-1;
        $arr_data[$row][$colIndex] = $data_value;
    }

}
$this->load->library('table');


$this->table->set_heading($header[1]);


for ($i=2; $i<=count($arr_data)+1; $i++) {
/*foreach ($arr_data[$i] as $key => $value) {
  $tbl[]=$value;
}
}*/

for($j=0;$j<count($header[1]);$j++)
{

  if(isset($arr_data[$i][$j]))
 $tbl[]=$arr_data[$i][$j]; 
else
  $tbl[]=' ';
}
}

$new_tbl = $this->table->make_columns($tbl, count($header[1]));
$tmpl = array (
                    'table_open'          => '<table border="1" cellpadding="2" cellspacing="1" align="center">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

$this->table->set_template($tmpl);
$html=$this->table->generate($new_tbl);
if($this->session->userdata('logged_in')){
  $row=array();
  for($i=0;$i<count($arr_data);$i++)
  $row[]='';

$table=array (
  "id_user"=> $this->session->userdata('id_user'),
     "table_name"=> $filename,
     "rows"=>implode(",,",$row),
     "columns"=>implode(",,",$header['1']),
     "fields"=>implode(",,",$tbl),
    "fname"=>'Field Name',
     "ftext"=>'Description',
      );
      
   

   $this->load->model('table_model');
   $this->table_model->insert_table($table);
    
}




$this->pdf($html,'print');



$this->load->helper('file');
delete_files('./docs/');
}


}




