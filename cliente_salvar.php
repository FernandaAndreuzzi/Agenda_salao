<?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nome = $_POST['Nome'];
                $telefone = $_POST['Telefone'];
                $cpf = $_POST['Cpf'];
                $dataNascimento = $_POST['DataNascimento'];
                $email = $_POST['email'];
                $logradouro = $_POST['Logradouro'];
                $numero = $_POST['Numero'];
                $tipoPessoa = $_POST['TipoPessoa'];
                $senha = password_hash($_POST['Senha'], PASSWORD_DEFAULT); 
                $situacao = $_POST['Situacao'];
                $dataConvertida = DateTime::createFromFormat('Y-m-d', $dataNascimento)->format('Y/m/d');

                
                if (!validarCPF($cpf)) {
                    echo "<p style='color:red;'>CPF inválido! Tente novamente❌</p>";
                } else {
                    if ($id != 0) {
                        $sql = "UPDATE Pessoas SET 
                                Nome = '$nome', 
                                Email = '$email', 
                                Telefone = '$telefone',
                                Cpf = '$cpf',
                                DataNascimento = '$dataConvertida',
                                Logradouro = '$logradouro',
                                Numero = '$numero',
                                TipoPessoa = '$tipoPessoa',
                                Senha = '$senha',
                                Situacao = '$situacao'
                                WHERE IdPessoa = $id";

                        if ($conn->query($sql) === TRUE) {
                            echo "<p style='color:green;'>Usuário(a) atualizado(a) com sucesso!✅</p>";
                        } else {
                            echo "<p style='color:red;'>Erro ao atualizar❌: " . $conn->error . "</p>";
                        }
                    } else {
                        $sql = "INSERT INTO Pessoas 
                                (Nome, Email, Telefone, Cpf, DataNascimento, Logradouro, Numero, TipoPessoa, Senha, Situacao) 
                                VALUES ('$nome', '$email', '$telefone', '$cpf', '$dataConvertida', '$logradouro', '$numero', '$tipoPessoa', '$senha', '$situacao')";

                        if ($conn->query($sql) === TRUE) {
                            echo "<p style='color:green;'>Cadastrado(a) com sucesso!✅</p>";
                        } else {
                            echo "<p style='color:red;'>Erro no cadastro❌: " . $conn->error . "</p>";
                        }
                    }
                }
                $conn->close();
            }
            ?>