# Autor
---

<sub>
<a href="https://alessandrodesign.com.br/portal">
<img src="https://avatars.githubusercontent.com/u/17950612?v=4" width="35px;" alt=""/>
</a>
</sub>
<sup>
Feito com ❤️ por
<a href="https://alessandrodesign.com.br/portal"><b>Alessandro Souza</b></a>
</sup>

[![Twitter Badge](https://img.shields.io/badge/-@alessandrodesig-1ca0f1?style=flat-square&labelColor=1ca0f1&logo=twitter&logoColor=white&link=https://twitter.com/alessandrodesig)](https://twitter.com/alessandrodesig)
[![Linkedin Badge](https://img.shields.io/badge/-AlessandroSouza-blue?style=flat-square&logo=Linkedin&logoColor=white&link=https://www.linkedin.com/in/alessandrodesign/)](https://www.linkedin.com/in/alessandrodesign/)

Grato pela oportunidade, segue projeto.

# Inicializando o docker-compose

```bash
docker-compose -d up
```

### Após carregado, acesse: http://localhost:8000

# Acessando o bash do kafka

```bash
docker exec -it croct-tech-kafka bash
```

# Criando um tópico

```bash
kafka-topics --create --topic=default --bootstrap-server=localhost:9092 --partitions=3

kafka-topics --create --topic=location --bootstrap-server=localhost:9092 --partitions=3
```

# Criando um consumer

```bash
kafka-console-consumer --bootstrap-server=localhost:9092 --topic=default
kafka-console-consumer --bootstrap-server=localhost:9092 --topic=location
```

## Criando um consumer pertencente a um grupo

```bash
kafka-console-consumer --bootstrap-server=localhost:9092 --topic=default --group=group
kafka-console-consumer --bootstrap-server=localhost:9092 --topic=location --group=group
```

``--from-beginning`` força a leitura do início de todas as mensagens

# Criando producer

```bash
kafka-console-producer --bootstrap-server=localhost:9092 --topic=default
kafka-console-producer --bootstrap-server=localhost:9092 --topic=location
```