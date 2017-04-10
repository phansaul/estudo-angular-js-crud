<!-- ng-app definindo o nome da aplicação -->
<html ng-app="listaTelefonica"> 

<?php include "head.php" ?>

<!-- ng-controller definindo onde o controller atuará -->
<body ng-controller="listaTelefonicaCtrl">
	<div class="jumbotron col-md-4 col-md-offset-4">
		<h3 ng-bind="app"></h3>
		<!-- Barra de pesquisa definida no modelo -->
		<input class="form-control" type="text" ng-model="search" placeholder="Pesquisar"> 
		<!-- ng-show só irá aparecer se existir algum valor nos arrays -->
		<table class="table" ng-show="contatos.length > 0">
			<tr>
				<th></th>
				<!-- Chama a função de ordenação de coluna por click -->
				<th><span ng-click="ordenarPor('nome')">Nome</span></th>
				<th><span ng-click="ordenarPor('telefone')">Telefone</span></th>
				<th><span ng-click="ordenarPor('operadora')">Operadora</span></th> 
				<th><span ng-click="ordenarPor('date')">Data</span></th>
			</tr>
			<!-- As rows então em loop (filtradas pelo seach definido acima), ordenadas de acordo com a função ordenarPor -->
			<tr ng-class="{'selecionado negrito': contato.selecionado}" ng-repeat="contato in contatos | filter: {nome: search} | orderBy: ordenarProp:dirOrd">
				<td><input type="checkbox" ng-class="" ng-model="contato.selecionado" /></td>
				<!-- {{array.pos chamando o valor de cada um}} -->
				<td>{{contato.nome}}</td>
				<td>{{contato.telefone}}</td>
				<td>{{contato.operadora.nome}}</td>
				<td>{{contato.date | date:'EEE dd/MM/yyyy HH:mm'}}</td>
			</tr>
		</table>

		<hr />

		<form name="contatoForm">
			<div class="form-group">
				<!-- Cada input recebe um ng-model, para depois se encaixarem no array. O ng-required e minlength são os validadores -->
				<input class="form-control" type="text" ng-model="contato.nome" placeholder="Nome" name="nome" ng-required="true" ng-minlength="10"/>
			</div>
			<div class="form-group">
				<input class="form-control" id="tel" type="text" ng-model="contato.telefone" placeholder="Telefone" name="telefone" ng-required="true" maxlength="11" />
			</div>

			<div class="form-group">
				<!-- O loop ng-options popula o select baseado no array operadora. O que acontece ali é a concatenação do nome com o preço por minuto -->		
				<select class="form-control" ng-model="contato.operadora" ng-options="operadora.nome + ' (' + (operadora.preco | currency) + ')' for operadora in operadoras | orderBy:'nome'">
					<option value="">Selecione uma Operadora</option>
				</select>
			</div>
			<div class="form-group">
				<!-- Chama a função adicionarContato, passando o model de contato definido nos inputs e no select. O botão só é habilitado quando o form é válido -->
				<button class="btn btn-primary btn-block" ng-click="adicionarContato(contato)" ng-disabled="contatoForm.$invalid" ng-if="!isContatoSelecionado(contatos)" name="add">Adicionar</button>
			</div>
			<div class="form-group">
				<!-- Assim como em adicionar, mas agora o código html só é inserido na página quando algum checkbox for marcado -->
				<button class="btn btn-danger btn-block" ng-click="apagarContato(contatos)" ng-disabled="false" ng-if="isContatoSelecionado(contatos)">Apagar</button>
			</div>
		</form>

		<!-- Mensagens de Alerta intuitivas 
			 No ng-show, só serão mostradas as mensagens quando o form for inválido e os campos nome e telefone foram preenchidos e depois apagados. -->
		<div class="alert alert-danger" ng-show="contatoForm.$invalid && contatoForm.nome.$dirty && contatoForm.telefone.$dirty">
			<!-- O módulo de mensagens do angular consegue instanciar a validação para tipos específicos, como required e minlength -->
			<div ng-messages="contatoForm.nome.$error">
				<div ng-message="required">
					Por favor, preencha o campo nome!
				</div>
				<div ng-message="minlength">
					O campo nome deve ter no mínimo 10 caracteres.
				</div>
			</div>
			<div ng-messages="contatoForm.telefone.$error">
				<span ng-message="required">Por favor, preencha o campo telefone!</span>
			</div>
		</div>

	</div>

	<footer>
		<div class="footer text-center row col-md-12">
				<h4>Estudo <b>em desenvolvimento</b> por Paulo Henrique Hansaul Jorge</h4>
				<h5>Baseado no <a href="https://www.youtube.com/playlist?list=PLQCmSnNFVYnTD5p2fR4EXmtlR6jQJMbPb" target="_blank">tutorial</a> de AngularJS de Rodrigo Banas</h5>
		</div>
	</footer>
</body>

<script type="text/javascript" src="js/limitador-do-input.js"></script>

</html>	