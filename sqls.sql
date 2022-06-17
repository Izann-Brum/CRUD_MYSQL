
SET FOREIGN_KEY_CHECKS=0

UPDATE LIVRO SET Nome_autor_l='Autor 01' WHERE Nome_autor_l='Autor 1';
UPDATE LIVRO_AUTOR SET Nome_autor='Autor 01' WHERE Cod_autor=1;
ALTER TABLE LIVRO DROP INDEX LIVRO_fk1;

SELECT Titulo, Nome_autor_l, Nome_autor, Cod_autor FROM LIVRO INNER JOIN LIVRO_AUTOR ON Cod_autor=1;

UPDATE LIVRO_AUTOR SET Nome_autor = 'Teste 2' WHERE Cod_autor=1;

UPDATE LIVRO SET Nome_autor_l = 'Teste 2' INNER JOIN LIVRO_AUTOR ON Cod_autor=1;

 -------------

SELECT Nome_autor FROM LIVRO_AUTOR WHERE Cod_autor=1;

UPDATE LIVRO SET Nome_autor_l='Teste 2' WHERE Nome_autor_l='Autor 1';

UPDATE LIVRO_AUTOR SET Nome_autor = 'Teste 2' WHERE Cod_autor=1;

$Copias = $CopiasModel->QuantidadeCopias($Cod_unidadei, $Cod_livroi);
$arraToString = implode(',', $Copias[0]);
$stringToInt = intval($arrayToString);

INSERT INTO LIVRO_EMPRESTIMO (Cod_livro, Cod_unidade, Nr_cartao, Data_emprestimo, Data_devolucao) VALUES ($Cod_livro, $Cod_unidade, $Numero_cartao, 'DATE: Auto CURDATE()', CURDATE(), 'DATE: Manual Date', '16-06-2023');

SELECT Num_cartao, Nome, LIVRO.Cod_livro, Titulo, UNIDADE_BIBLIOTECA.Cod_unidade, Nome_unidade, DATE_FORMAT('Data_emprestimo', '%m/%d/%Y'), DATE_FORMAT('Data_devolucao', '%m/%d/%Y') FROM LIVRO_EMPRESTIMO INNER JOIN LIVRO ON LIVRO_EMPRESTIMO.Cod_livro=LIVRO.Cod_livro INNER JOIN USUARIO ON Num_cartao=Nr_cartao INNER JOIN UNIDADE_BIBLIOTECA ON LIVRO_EMPRESTIMO.Cod_unidade=UNIDADE_BIBLIOTECA.Cod_unidade;

INSERT INTO LIVRO_EMPRESTIMO (Cod_livro, Cod_unidade, Nr_cartao, Data_emprestimo, Data_devolucao) VALUES (7, 1, 1, CURDATE(), date_add(CURDATE(), interval 1 month));