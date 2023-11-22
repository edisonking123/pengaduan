<?php 
	session_start();
	include '../conn/koneksi.php';
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	elseif($_SESSION['data']['level'] != "admin"){
		header('location:../index.php');
	}
 ?>
  <!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>

      <!-- Compiled and minified CSS -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

      <!-- Compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      
      
      <script type="text/javascript">
        $(document).ready( function () {
          $('#example').DataTable();
          $('select').formSelect();
        } );
      
      </script>
    </head>

    <body style="background:url(../img/bc1.jpg); background-size: cover;">
<br>
    <div class="row">
      <div class="col s12 m3">
          <ul id="slide-out" class="sidenav sidenav-fixed">
              <li>
                  <div class="user-view">
                      <div class="background">
                          <img src="../img/bc.jpg">
                      </div>
                      <a href="profil.html"><img src="../img/ed.png" style=" width:80px; height: 80px;"></a>
                      <a href="#name"><span class="blue-text name"><?php echo ucwords($_SESSION['data']['nama_petugas']); ?></span></a>
					  
                  </div>
              </li>
              <li><a href="index.php?p=dashboard"><i class="material-icons">dashboard</i>Dashboard</a></li>
              <li><a href="index.php?p=registrasi"><i class="material-icons">featured_play_list</i>Registrasi</a></li>
              <li><a href="index.php?p=pengaduan"><i class="material-icons">report</i>Pengaduan</a></li>
              <li><a href="index.php?p=respon"><i class="material-icons">question_answer</i>Respon</a></li>
              <li><a href="index.php?p=user"><i class="material-icons">account_box</i>User</a></li>
              <li><a href="index.php?p=laporan"><i class="material-icons">book</i>Laporan</a></li>
              <li>
                  <div class="divider"></div>
              </li>
              <li><a class="waves-effect" href="../index.php?p=logout"><i class="material-icons">logout</i>Logout</a></li>
          </ul>

          <a href="#" data-target="slide-out" class="btn sidenav-trigger"><i class="material-icons">menu</i></a>
      </div>

      <div class="col s12 m9">
        
	<?php 
		if(@$_GET['p']==""){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="dashboard"){
			include_once 'dashboard.php';
		}
		elseif(@$_GET['p']=="registrasi"){
			include_once 'registrasi.php';
		}
		elseif(@$_GET['p']=="regis_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM masyarakat WHERE nik='".$_GET['nik']."'");
			if($query){
				header('location:index.php?p=registrasi');
			}
		}
		elseif(@$_GET['p']=="pengaduan"){
			include_once 'pengaduan.php';
		}
		elseif(@$_GET['p']=="pengaduan_hapus"){
			$query=mysqli_query($koneksi,"SELECT * FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
			$data=mysqli_fetch_assoc($query);
			unlink('../img/'.$data['foto']);
			if($data['status']=="proses"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				header('location:index.php?p=pengaduan');
			}
			elseif($data['status']=="selesai"){
				$delete=mysqli_query($koneksi,"DELETE FROM pengaduan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
				if($delete){
					$delete2=mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
					header('location:index.php?p=pengaduan');
				}	
			}

		}
		elseif(@$_GET['p']=="more"){
			include_once 'more.php';
		}
		elseif(@$_GET['p']=="respon"){
			include_once 'respon.php';
		}
		elseif(@$_GET['p']=="tanggapan_hapus"){
			
			$query = mysqli_query($koneksi,"DELETE FROM tanggapan WHERE id_tanggapan='".$_GET['id_tanggapan']."'");
			if($query){
				header('location:index.php?p=respon');
			}
		}
		elseif(@$_GET['p']=="user"){
			include_once 'user.php';
		}
		elseif(@$_GET['p']=="user_input"){
			include_once 'user_input.php';
		}
		elseif(@$_GET['p']=="user_edit"){
			include_once 'user_edit.php';
		}
		elseif(@$_GET['p']=="user_hapus"){
			$query = mysqli_query($koneksi,"DELETE FROM petugas WHERE id_petugas='".$_GET['id_petugas']."'");
			if($query){
				header('location:index.php?p=user');
			}
		}
		elseif(@$_GET['p']=="laporan"){
			include_once 'laporan.php';
		}
	 ?>

      </div>


    </div>
	<div footer>
    <div class="button">
        <center><button>
            <a href="index.html">Makasih</a>
        </button>
	</center>
	</div>
	<style> @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;1,900&display=swap');
*{
    font-family: 'Poppins',cursive;
}
.greetings{
    font-size: 4rem;
    font-weight: 900;
}
.greetings > span{
    animation: glow 2.5s ease-in-out infinite;
}
@keyframes glow{
    0%, 100%{
        color: #fff;
        text-shadow: 0 0 12px #39c6d6, 0 0 50px #39c6d6, 0 0 100px #39c6d6;
    }
    10%, 90%{
        color: #111;
        text-shadow: none;
    }
}
.greetings > span:nth-child(2){
    animation-delay: .2s ;
}
.greetings > span:nth-child(3){
    animation-delay: .4s ;
}
.greetings > span:nth-child(4){
    animation-delay: .6s;
}
.greetings > span:nth-child(5){
    animation-delay: .8s ;
}
.greetings > span:nth-child(6){
    animation-delay: 1s ;
}
.greetings > span:nth-child(7){
    animation-delay: 1.2s ;
}
.greetings > span:nth-child(8){
    animation-delay: 1.3s ;
}
.greetings > span:nth-child(9){
    animation-delay: 1.4s ;
}
.greetings > span:nth-child(10){
    animation-delay: 1.5s;
}
.greetings > span:nth-child(11){
    animation-delay: 1.6s ;
}
.greetings > span:nth-child(12){
    animation-delay: 1.8s ;
}
.greetings > span:nth-child(13){
    animation-delay: 2s ;
}

.description{
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.button a{
    text-decoration: none;
    font-size: 1rem;
    color: #111;
}

@media screen and (max-width:574px){
    .greetings{
        display: block;
        font-size: 3rem;
        font-weight: 500;
        text-align: center;
    }
    .description{
        font-size: 1rem;
    }
    
    .button a{
        font-size: .5rem;
    }
}
</style>
<br>
<br>
<br>
<br>
<br>
<br>    
<br>
<br>
<br>
<center>
	<marquee>
	<div class="greetings">
    <!-- silahkan menambah kata sesuai keinginan dengan <span>text...</span -->
        <span>T</span>
        <span>H</span>
        <span>A</span>
        <span>N</span>
        <span>K</span>
		
		<span></span>
		<span></span>
		<span>&ensp;Y</span>
		<span>O</span>
		<span>U</span>
        <br>
</marquee>
<br>
    </div>
	</div>
</center>



      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="../js/materialize.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);
        });

        document.addEventListener('DOMContentLoaded', function() {
          var elems = document.querySelectorAll('.modal');
          var instances = M.Modal.init(elems);
        });

      </script>

    </body>
  </html>