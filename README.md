Simple Chat - O Chat Simples
=======================================

Este chat foi desenvolvido utilizando PHP, MySQL, Javascript, HTML e CSS, sendo assim, se faz necessária a utilização de um servidor. Esse 
projeto possuí fins academicos, onde, por meio dessa ideia, se pode desenvolver sistemas diferentes e diversos.

Funções
-------

O chat já conta com sistema de usuários, cadastro, chat global, chat privado, com atualizações automáticas, e emojis.

Desenvolvimento
---------------

* Comunicação com o banco: Feita por meio do PDO
* Atualmente existe um aquivo chamado 'Sys.php' dentro da pasta 'class', que possuí funções mais genéricas
* Existe um arquivo de inicialização que inclui a classe de Sistema, faz uma instância e válida a sessão do usuário
* Pasta "actions/" contém as ações do sistema
* As atualizações das mensagens são feitas por meio de um "setInterval" no Javascript, que faz a consulta para um ajax que retorna as mensagens
