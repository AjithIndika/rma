<?php 

if(empty($this->session->userid)){
   redirect(base_url('page/logout'));
}
?>
<div class="container" style="margin-top: 80px">

    <form class="navbar-left navbar-form nav-search mr-md-3" action="">
        <div class="input-group col-sm-8">
            <input type="text" placeholder="Search ..." class="form-control " onkeyup="showResult(this.value)">
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-search search-icon"></i>
                </span>
            </div>

        </div>
        <div id="livesearch" class="rounded sticky-top sticky-offset col-sm-8"></div>
    </form>

</div>
