<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php $this->load->helper('url');
      echo site_url('/');?>">Table</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php $this->load->helper('url');
      echo site_url('/');?>">Create Table</a>
                    </li>
                    <li>
                        <a href="<?php $this->load->helper('url');
      echo site_url('home/show_tables');?>">Show tables</a>
                    </li>
                    <li>
                        <a href="<?php $this->load->helper('url');
      echo site_url('home/uploadTable');?>">Upload Table</a>
                    </li>
                    <li>
                        <a href="<?php $this->load->helper('url');
      echo site_url('home/logout');?>">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="container">
    </br>
     </br>