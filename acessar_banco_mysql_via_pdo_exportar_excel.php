<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Exportar Dados para o Excel</title>
	<head>
	<body>
		<?php
			$usuario = 'root';
			$senha = '';

			// Realizamos a conexão com o banco de dados (via PDO) e fazemos um select em uma das tabelas.
			$conn = new PDO('mysql:host=localhost;dbname=db_teste', $usuario, $senha);
			$sql = "SELECT * from tb_cliente";
			$stmt = $conn->prepare($sql);
			$run = $stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_BOTH);

			// Definimos o nome do arquivo que será exportado
			$arquivo = 'clientes.xlsx';
			
			// Criamos uma tabela HTML com o formato da planilha
			$html = '';
			$html .= '<table border="1">';
			
			$html .= '<tr>';
			$html .= '<td><b>ID</b></td>';
			$html .= '<td><b>Nome</b></td>';
			$html .= '</tr>';

			foreach ($result as $row)
			{
				$html .= '<tr>';
				$html .= '<td>'.$row["clie_cd_codigo"].'</td>';
				$html .= '<td>'.$row["clie_tx_nome"].'</td>';
				$html .= '</tr>';
			}
			$html .= '</table>';
			
			// Configurações header para forçar o download
			header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
			header ("Cache-Control: no-cache, must-revalidate");
			header ("Pragma: no-cache");
			header ("Content-type: application/x-msexcel");
			header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
			header ("Content-Description: PHP Generated Data" );

			// Envia o conteúdo do arquivo
			echo $html;
			exit; 
		?>
	</body>
</html>