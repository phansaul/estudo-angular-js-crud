angular.module("listaTelefonica", ["ngMessages"]);

angular.module("listaTelefonica").controller("listaTelefonicaCtrl", function($scope){
	$scope.app = "Lista Telefônica";

	// Definição do primeiro array
	$scope.contatos = [
		{nome:"Pedro", telefone: "99998888", date: new Date(), operadora: {nome: "Oi", codigo: 14, categoria:"Celular", preco: 1}},
		{nome:"Paulo", telefone: "98192932", date: new Date(), operadora: {nome: "Vivo", codigo: 15, categoria:"Celular", preco: 2}},
		{nome:"Jão", telefone: "97563852", date: new Date(), operadora: {nome: "TIM", codigo: 41, categoria:"Celular", preco: 0.75}},
	];

	// Definição do segundo array
	$scope.operadoras = [
		{nome: "Oi", codigo: 14, categoria:"Celular", preco: 1},
		{nome: "VIVO", codigo: 15, categoria:"Celular", preco: 2},
		{nome: "TIM", codigo: 41, categoria:"Celular", preco: 0.75},
		{nome: "GVT", codigo: 25, categoria:"Fixo", preco: 1},
		{nome: "Embratel", codigo: 21, categoria:"Fixo", preco: 0.35},	
	];
		
	$scope.adicionarContato = function(contato){
	//  Adiciona ao array por meio do push
		$scope.contatos.push(angular.copy(contato));
		delete $scope.contato;
	//  Limpa o cachê do formulário
		$scope.contatoForm.$setPristine();
	};

	$scope.apagarContato = function(contatos){
	//  Filtra todo o array contatos por meio do contato selecionado no checkbox
		$scope.contatos = contatos.filter(function(contato){
	//      Retorna apenas os contatos que não são o selecionado
			if (!contato.selecionado) return contato;
		});
	// Obs.: Este método só funciona em um exemplo utilizando arrays
	};

	$scope.isContatoSelecionado = function(contatos){
		return contatos.some(function(contato){
			return contato.selecionado;
		});
	};

	// Exemplos de Estilização por meio de ng-style...
	$scope.classe1 = "selecionado"; 
	$scope.classe2 = "negrito";

	$scope.ordenarPor = function(campo){
		$scope.ordenarProp = campo;
	//  Inverte a ordem da coluna
		$scope.dirOrd = !$scope.dirOrd;
	};
});