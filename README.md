## Como rodar a aplicação na sua maquina:
<uL>
    <li>Rodar <code>$ composer i</code></li>
    <li>Rodar <code>$ php artisan migrate</code></li>
    <li>
        Vai aparecer a seguinte mensagem<br> 
        <code>WARN  The SQLite database does not exist: C:\www\todo-app\database\db.sqlite. </code><br>
        <code>Would you like to create it? (yes/no) [no] </code>
    <br>Digite "Yes" e prossiga</li>
    <li>Rodar <code>$ php artisan db:seed</code></li>
    <li>Rodar <code>$ npm run dev</code></li>
    <li>E por fim rodar <code>$ php artisan serve</code></li>
</uL>

OBS: Aplicação foi criada com php 8.2 e laravel 10, usar uma versão diferente pode apresentar problemas
