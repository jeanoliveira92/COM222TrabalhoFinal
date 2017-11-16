VinumWeb

COM222 – Desenvolvimento de Sistemas Web
Trabalho em Grupo
Apresentação: 20 ou 23/11
Neste trabalho cada grupo deverá implementar um sistema para cadastramento, avaliação e consulta de vinhos, semelhante ao Vivino (www.vivino.com).
Para o cadastramento de vinhos, o Vivino utiliza um app que permite que o usuário tire uma foto do rótulo dos vinhos que possui. Os vinhos são identificados de maneira automática pela foto do rótulo, e o usuário pode ver as avaliações já existentes (se houver). Após consumir o vinho, o usuário pode avaliá-lo, dando uma nota de 0 a 5, com intervalo decimal.
Como sua implementação não poderá contar com o apoio do app, o cadastramento dos vinhos deve ser feito com o upload da imagem do rótulo da garrafa. O usuário deverá digitar o nome do produtor (vinícola) e o nome do vinho. No processo de digitação, deve-se utilizar um mecanismo de sugestão que mostra nomes similares já cadastrados. Isso é importante para evitar que um mesmo vinho seja cadastrado em duplicidade. Note que esse mecanismo permite que cada usuário cadastre os rótulos que possui. Assim, os rótulos cadastrados passam a fazer parte de uma lista individual de cada usuário, chamada “My Wines”, sendo que um mesmo vinho pode constar em várias listas.
No sentido de simplificar a implementação, não será necessário digitar o ano do rótulo (safra). No momento do cadastramento, deve-se informar:
- a região e o país de origem;
- o tipo do vinho (tinto, branco, rosé, etc.);
- o estilo do vinho;
- o tipo de uva (ou blend, se for uma mistura de uvas);
- a harmonização com comidas.
Note que, se já houver um vinho cadastrado, deve ser possível modificar essas informações ou acrescentar novas, no caso da harmonização com comidas, por exemplo.
O cadastramento de novos vinhos só pode ser feito por usuários previamente cadastrados. O cadastramento do usuário é feito utilizando seu email e uma senha.
Ao acessar o site, o usuário pode navegar sem fazer login. Neste caso, poderá apenas fazer consultas. O mecanismo de consultas será detalhado adiante. Ao navegar sem login, deve aparecer em todas as páginas opões para realizar Login e Sign up (cadastramento). No momento que o usuário faz login, aparece seu nome no topo da tela e, ao lado, aparece o link “My Wines”. Ao clicar em My Wines, o usuário vê os rótulos que cadastrou. Ao clicar em um rótulo, ele deve ver todas as informações do vinho e deve também ser capaz de avaliá-lo, com uma nota de 0 a 5. Além disso, opcionalmente, o usuário pode escrever uma avaliação (review) do vinho. A avaliação numérica e o review, após serem submetidos, passam a aparecer para os demais usuários quando consultarem o vinho avaliado. Consullta
O mecanismo de consulta deve ter funcionalidade idêntica ao site do Vivino. Na página principal deve haver um combo box para a seleção do tipo de vinho, e dois sliders, um para seleção do intervalo de preço e outro para seleção do número de estrelas (avaliação).
Nas demais páginas, além desses três mecanismos de seleção, deve ser possível selecionar vinhos por:
- região e/ou país;
- estilo do vinho;
- tipo do vinho;
- tipo de uva;
- harmonização com comidas.
A modificação dos parâmetros de consulta deve resultar na atualização da lista de vinhos exibida. Qualquer dúvida em relação ao procedimento de consulta, vá direto ao site do Vivino e veja como é feito lá. O que você deve fazer é um mecanismo de consulta o mais parecido possível – em termos de funcionalidade – com o que é provido pelo Vivino. Reviiews
Ao exibir um vinho, deve-se mostrar a média de suas avaliações (número de estrelas) e os seus reviews, sendo que cada review deve ser identificado. Ao clicar no nome associado ao review, o site deve ir para a página do revisor, a qual deve exibir todas as suas revisões, aparecendo primeiro as mais recentes.
Importante:
- Todos os alunos do grupo devem estar presentes na apresentação
- O codigo fonte do projeto juntamente com o script para a criação do banco de dados devem ser enviados para com222@gmail.com no dia da apresentação.
