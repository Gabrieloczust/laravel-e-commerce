## Info

Sistema básico de uma LOJA para praticar conhecimentos obtidos do Laravel, está dividido em duas áreas, sendo a frente responsável pela apresentação/compra dos produtos atráves de um carrinho, e área de admin para cadastro de categorias/produtos e apresentação de gráficos sobre as vendas.

## Ambiente de teste
Criar tabelas no banco:
- php artisan migrate:fresh

Criar produtos/categorias/vendas aleatórios:
- php artisan db:seed

## Ajustes

- Modal para confirmação de exclusão em produtos
- Carrinho de compras erro na sessão ao adicionar novo produto
- Gráfico de vendas exportar relatório
- Versão mobile do carrinho
- API para as Categorias

## Versões

- Composer 1.9.1
- Laravel 6.11.0
- Laravel Installer 3.0.1
- [PHP 7.4.2](https://windows.php.net/downloads/releases/php-7.4.2-nts-Win32-vc15-x64.zip)

- [AdminLTE 3.0.8](https://github.com/jeroennoten/Laravel-AdminLTE)
- [DataTables 1.10.19](https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js)
- [Chartjs 2.7.0](https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js)

- [Boostrap 4.4.1](https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js)
- [Jquery 1.11.1](https://code.jquery.com/jquery.min.js)
- [Popper 1.16.0](https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js)