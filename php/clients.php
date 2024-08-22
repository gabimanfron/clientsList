<!--Código de que mostra a lista de clientes-->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../css/style.css"> <!-- Inclui o arquivo CSS para estilização -->
</head>
<body>
    <div class="container">
        <h1>Lista de Clientes</h1>
        <nav>
            <ul>
                <li><a href="new_client.php">Adicionar Novo Cliente</a></li> <!--Link para adicionar cliente ao banco de dados-->
                <li><a href="logout.php">Sair</a></li> <!--Link para encerrar sessão-->
            </ul>
        </nav>
    <!--Tabela que mostra dados dos clientes-->    
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Endereço</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../db/config.php';

                $result = $conn->query("SELECT * FROM clients");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['document']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['address']}</td>
                        <td>
                            <a href='edit_client.php?id={$row['id']}'>Editar</a>  |
                            <a href='process_delete.php?id={$row['id']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                        </td>
                    </tr>";
                } //Links para editar e ecluir cliente da base de dados

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>