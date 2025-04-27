<!-- Nome do sistema -->
# Parna Peruaçu 

Esse sistema tem como objetivo, facilitar o processo de agendamento de visitas ao Parna Cavernas do Peruaçu.

Desenvolvido ultilizando o framework
Laravel 10.38.

## Dependências do sistema
* PHP 8.1
* Composer 2.5
* Mysql 8.0


<!-- ### Configuração de envio de emails de teste
 Usar o mailtrap -->

## Intruções para baixar e executar o projeto 

* ### Opção 1
    * Configurar chave ssh 
    * clonar o repositório
    * Instalar o docker
    * usar o sail para subir os containers 
    
* ### Opção 2
    * Configurar chave ssh 
    * clonar o repositório
    * Baixar php com extenções ..
    * Baixar compose
    * baixar o docker 
    * usar o sail para usar o mysql
    
* ### Opção 3
    * Configurar chave ssh 
    * clonar o repositório
    * Baixar php com extenções ..
    * Baixar compose
    * Baixar o mysql

<br>

## Padrões do projeto
---
### Fluxo de trabalho no git 
Nesse projeto é usado um padrão de fluxo de trabalho baseado no git flow. 
Onde Existe uma branch master e dev e também branchs de features, refactor, hotfix(a partir da master) e bugfix(apartir da dev). Onde toda feature é primeira testada na dev e só depois é feito um pull request para master.

Para nomear as branch é recomendavel seguir o seguinte padrão:
```bash 
tipo/nome-da-branch

#exemplo
feature/add-authetication
```


<br>

### Padrões de commits

Os commits seguem um padrão baseado no padrão sugerido pelo jira. Esses commits recebem um código de uma tarefa ao qual ele está relacionado, tornando assim mais fácil gerenciamento do projeto no jira. O padrão descrito logo a baixo:

```
:emoji: [tipo]( arquivou ou contexto que foi mexido): Mensagem . [codigo do jira issue] [ #transition] 

Os tipos de transição(#transition) do projeto são: #to(To do), #in(em progresso), #review(revisão de código) e #done(concluido)

Exemplo prático:
:books: docs(Readme): Atualiza o readme. #ES-4 #done.

```
### Tipos de commits
	Feature (feat)
	💄 :lipstick:   -> estilo css
	✨ :sparkles: -> qualquer nova funcionalidade
	
	Em progresso (wip)
	🚧 :construction:  
	
	Commit inicial (init)
	🎉 :tada:

	refactor (refactor)
	🌀 :cyclone: 

	Bug não muito urgente (fix)
	🔧 :wrench:

	bug muito urgente (hotfix)
	🚑 :ambulance:

	Infraestrutura (ci)
    🛠️ :tools:

    documentação (docs)
    📚 :books:
 
<!-- Cololcar uma seção para orientar sobre os padrões de git. Commits e fluxo de trabalho -->
    
