<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/profile.css">

<style type="text/css">
#mainContainer{
    /*background:Red;*/
    min-width:850px;
}
.container1{
    text-align:center;
    margin:10px .5%;
    padding:10px .5%;
    /*background:green;*/
    float:left;
    overflow:visible;*/
    position:relative;
}


.member{
    background:#eee;   
    position:relative;
    z-index:   1;
    cursor:default;
    border-bottom:solid 1px #000;
}
.member:after{
    display:block;
    position:absolute;
    left:50%;
    width:1px; 
    height:20px;
    background:#000;
    content:" ";
    bottom:100%;
}
.member:hover{
 z-index:   2;
}
.member .metaInfo{
    display:none;
    border:solid 1px #000;
    background:#fff;
    position:absolute;
    bottom:100%;
    left:50%;
    padding:5px;
    width:100px;
}
.member:hover .metaInfo{
    display:block;   
}
.member .metaInfo img{
  width:50px;
  height:50px; 
  display:inline-block; 
  padding:5px;
  margin-right:5px;
    vertical-align:top;
  border:solid 1px #aaa;
}
</style>


<div class="container">
    <div class="row profile">
		  <?php include_once 'account_sidebar.php'; ?>
		<div class="col-md-9 ">
  			<div class="panel panel-default">
				<div class="panel-heading">
					MLM
				</div>
				<div class="panel-body">
					<div id="mainContainer" class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="section-padding"></div>


 