<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do-List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
     <style>
        table {
            
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
  </head>
  <body>
  <div class = "container" style = "text-align: center; margin-top: 25px;" >
    	<h1>ToDoList</h1>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-6">
			
			<form method="POST">
			  <input type="text" name="new_value">
			  <input type="submit" name="submit" value="Tambah Pekerjaan">
		   </form>
   
		<?php
		$tasks = [
			['id' => 1,'title' => 'Belajar PHP', 'status' => 'belum'],
			['id' => 2,'title' => 'Kerjakan Tugas UX', 'status' => 'selesai'],
			['id' => 3,'title' => 'Tugas Kelompok', 'status' => 'selesai'],
			// Tambahkan lebih banyak pengguna jika perlu
		];
		
		//tambah form
		array_push($tasks, ['id' => 4,'title' => 'Tugas Individu', 'status' => 'belum']);
		
		
		echo '<table border="1">';
		echo '<tr><th style="width:50%">Pekerjaan</th><th>Status</th><th>Tindakan</th></tr>';

		foreach ($tasks as $task) {
            echo "<tr>";

            echo "<td>".$task['title']."</td>";
            echo "<td>".$task['status']."</td>";

            echo "<td>";
            echo "<a href='form-edit.php?id=".$task['id']."'>Edit</a> | ";
            echo "<a href='hapus.php?id=".$task['id']."'>Hapus</a>";
            echo "</td>";

            echo "</tr>";
		}
		
		
		echo '</table>';
		?>
		
			</div>
		</div>
	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  </body>
</html>