# Curso Laravel 5.3 + Vue.JS

Link do [Curso Laravel 5.3 + VueJS](http://sites.code.education/laravel-com-vuejs/)

### Requisitos

 - [Laravel Homestead](https://laravel.com/docs/master/homestead)

### Instalação

No seu arquivo `homestead.yaml` configure:


```
sites:
    - map: laravue.app 
      to: /home/vagrant/Code/Cursos/vue-laravel/public
      
ports:
    - send: 3000
      to: 3000
      
    - send: 3001
      to: 3001
```

Na sua pasta `~/Homestead`, baixe, instale e execute o projeto:

```sh
~$ cd ~/Homestead
~/Homestead$ vagrant up --provision
~/Homestead$ vagrant ssh
vagrant@homestead:~$ cd Code
vagrant@homestead:~/Code$ mkdir Cursos
vagrant@homestead:~/Code$ cd Cursos
vagrant@homestead:~/Code/Cursos$ git clone <repository> vue-laravel
vagrant@homestead:~/Code/Cursos$ cd vue-laravel
vagrant@homestead:~/Code/Cursos/vue-laravel$ npm install
vagrant@homestead:~/Code/Cursos/vue-laravel$ gulp
vagrant@homestead:~/Code/Cursos/vue-laravel$ npm run dev
```

Configure seu arquivo de hosts para apontar para o endereço `laravue.app`

```
192.168.10.10    laravue.app
```

No seu navegador, aponte para [http://laravue.app:3000](http://laravue.app:3000)

### Licença

OpenSource/[MIT License](https://tldrlegal.com/license/mit-license)

### Nota

Laravel 5.3 **ainda não foi lançado**. Este projeto usa a versão **5.3.0-RC1**