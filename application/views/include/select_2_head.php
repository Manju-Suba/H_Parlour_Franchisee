
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    
    <style>
       .select2-container--default .select2-selection--single{
           height:auto;
       }
       .select2-container--default .select2-selection--single .select2-selection__rendered{
            padding-top: 5px;
            padding-bottom: 5px;
       }
       .select2-container--default .select2-selection--single .select2-selection__arrow
       {
        top: 6px;
       }

		.wizard > .content > .body select.error {
			background: rgb(251, 227, 228);
			border: 1px solid #fbc2c4;
			color: #8a1f11;
		}
	</style>

<!-- <!?php
    // Check if 10 seconds have passed since the last action
    if (!isset($_SESSION['message']) || (time() - $_SESSION['message'] > 1)) {
        // Perform your action or set flash data here
        $_SESSION['message'] = time();


        $this->session->set_flashdata('message', '');

    }
?> -->


    