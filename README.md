# Acessando o bash do kafka

```bash
docker exec -it e57625c5650510505637a78ab9e6529435f368b3bffa68da290c14498c01a2a3 bash
```

# Criando um tópico

```bash
kafka-topics --create --topic=teste --bootstrap-server=localhost:9092 --partitions=3
```

# Criando um consumer

```bash
kafka-console-consumer --bootstrap-server=localhost:9092 --topic=teste
```

## Criando um consumer pertencente a um grupo

```bash
kafka-console-consumer --bootstrap-server=localhost:9092 --topic=teste --group=nome_do_grupo
```

``--from-beginning`` força a leitura do início de todas as mensagens

# Criando producer

```bash
kafka-console-producer --bootstrap-server=localhost:9092 --topic=teste
```