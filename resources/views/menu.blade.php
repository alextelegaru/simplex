

@section('menu')

<style>


    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";
body{font-family: 'Poppins', sans-serif;
     background: #fafafa}
p{font-family: 'Poppins', sans-serif;
  font-size: 1.1em;
	font-weight: 300;
	line-height: 1.7em;
	color: #999;
}
a,
a:hover,
a:focus{
	color: inherit;
	text-decoration: none;
	transition: all 0.3s;
}
.navbarx{
	padding: 15px 10px;
	background: #fff;
	border: none;
	border-radius: 0;
	margin-bottom: 40px;
	box-shadow: 1px 1px 3px rgba(0,0,0,0.1);
    z-index: -1;
}

.navbarx-btn{
	box-shadow: none;
	outline: none!important;
	border: none;
}

.line{
	width: 100%;
	height: 1px;
	border-bottom: 1px dashed #ffffff;
}

.wrapperx {
  position: absolute;
    display: flex;
    width: 100%;
    align-items: stretch;
    z-index: 4;
}
#sidebarx {
    min-width: 250px;
    max-width: 250px;
    background: #7386D5;
    color: black;
    transition: all 0.3s;
}
#sidebarx.active{
	margin-left: -250px;
}

#sidebarx .sidebarx-header{
	padding: 20px;
	background: #f7f7f7;
}
#sidebarx ul.components{
	padding: 20px 0px;
	border-bottom: 1px solid #47748b;
}

#sidebar ul p{
	padding: 10px;
	font-size: 1.1em;
	display: block;
}

#sidebarx ul li a{
	padding: 10px;
	font-size: 1.1em;
	display: block;
}
#sidebarx ul li a:hover {
    color: #7386D5;
    background: #fff;
}

#sidebarx ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}
a[data-toggle="collapse"] {
    position: relative;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}
a.download{
	background: #fff;
	color: #FF0000;
}
a.article,
a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}



@media(maz-width:768px){
	#sidebarx{margin-left: -250px;}
	#sidebarx.active{
		margin-left: 0px;
	}
	#sidebarxCollapse span{
		display: none;
	}
}



</style>
<div class="wrapperx">
    <nav id="sidebarx">
        <div class="sidebarx-header">
            <h3>Opciones Disponibles</h3>
        </div>


        <ul class="list-unstyled components">

            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">home1</a>
                    </li>
                    <li>
                        <a href="#">home2</a>
                    </li>
                    <li>
                        <a href="#">home3</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Page</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">page1</a>
                    </li>
                    <li>
                        <a href="#">page2</a>
                    </li>
                    <li>
                        <a href="#">page3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Services</a>
            </li>
            <li>
                <a href="#">Contactanos</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="#" class="article">Download code</a>
            </li>
            <li>




                <a class="download" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Cerrar Sesion') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
            </li>
        </ul>
    </nav>



        <button type="button" id="sidebarxCollapse" class="btn btn-info">
            <i class="fa fa-align-justify"></i> <span>Menu</span>
        </button>



    </div>







    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
	    $(document).ready(function(){
			$('#sidebarxCollapse').on('click',function(){
				$('#sidebarx').toggleClass('active');
			});
        });

	</script>



@endsection
