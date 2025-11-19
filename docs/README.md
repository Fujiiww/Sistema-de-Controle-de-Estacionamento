## Sistema de Controle de Estacionamento

## 🧾 Descrição do Projeto

Este projeto é um sistema simples de controle de estacionamento desenvolvido em PHP, utilizando boas práticas de programação, princípios SOLID e arquitetura organizada em camadas.

O sistema permite:

Registrar a entrada de veículos

Registrar a saída e calcular o valor a pagar

Listar todos os veículos (relatório)

Excluir registros

Visualizar o faturamento total do estacionamento

## 🏗️ Arquitetura Geral

O projeto é dividido em camadas para manter clareza e boa organização:

- src/
  - Domain/
    - Entity/
    - Pricing/
    - Repository/
    - Validation/
  - Application/
    - ParkingService.php
  - Infra/
    - Repository/
- public/
- database/
- vendor/

Camadas:

Domain → regras de negócio (entidades, validações e contratos)

Infra → implementação do banco (SQLite)

Application → lógica principal do sistema (ParkingService)

Public → interface simples com formulários HTML

Database → arquivo SQLite (.sqlite)

## 🧩 Principais Componentes

1. Entities (Entidades)

Representam os objetos principais do domínio:

Vehicle

Car, Truck, Motorcycle

Cada subclasse define seu próprio tipo, seguindo herança.

2. Pricing (Strategy Pattern)

Cada tipo de veículo tem sua própria regra de cálculo:

CarPricing

TruckPricing

MotorcyclePricing

Todas implementam PricingInterface.

Esse padrão evita condicionais e facilita adicionar novos tipos futuramente.

3. Repository Pattern

Para acesso ao banco de dados:

Interface: VehicleRepositoryInterface

Implementação: SqliteVehicleRepository

Permite trocar SQLite por outro banco sem alterar o sistema.

4. Validation

A classe PlateValidator valida os dois formatos oficiais de placa brasileira:

ABC1234

ABC1D23

5. ParkingService

Coordena o funcionamento geral:

Entrada de veículo

Saída com cálculo do preço

Listagem

Faturamento total

Toda a regra de negócio fica centralizada aqui.

## 🧮 Faturamento

O sistema calcula o total arrecadado somando todos os registros com saída finalizada.

O valor aparece na parte inferior do relatório (report.php).

## 📂 Fluxo do Sistema

Entrada
O usuário informa placa e tipo.
O sistema valida a placa e registra a entrada com a data/hora atual.

Saída
O usuário informa a placa.
O sistema calcula o valor com base no tempo de permanência.

Relatório
Exibe todos os veículos, completos ou não, com opção de excluir.

Faturamento
Total coletado pelo estacionamento.

## 🗄️ Banco de Dados

O sistema usa SQLite.

O arquivo fica em:

database/database.sqlite

E é criado automaticamente caso não exista.

## ▶️ Como Executar

1. Abra o diretório do XAMPP:

C:\xampp\htdocs\

2. Copie a pasta do projeto para dentro do htdocs, por exemplo:

C:\xampp\htdocs\Sistema-de-Controle-de-Estacionamento\

3. Inicie o Apache pelo XAMPP Control Panel:

4. No navegador, acesse:

http://localhost/Sistema-de-Controle-de-Estacionamento/public

