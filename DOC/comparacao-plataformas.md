---
title: "Comparação de Plataformas para Sites Institucionais"
subtitle: "Sistema próprio (Laravel/Docker) vs. UFOP Quick Start vs. Arizona Quickstart"
author: "Documentação técnica do projeto"
date: "Setembro de 2026"
lang: pt-BR
geometry: margin=2.5cm
toc: true
toc-depth: 2
colorlinks: true
linkcolor: purple
urlcolor: purple
mainfont: "Georgia"
---

\newpage

# 1. As três plataformas

## 1.1 Nosso sistema (este projeto)

- **Stack:** Laravel 13 + PHP 8.4, views em Blade puro, front-end em Bootstrap + Font Awesome auto-hospedados (sem CDN externo).
- **Sem banco de dados:** todo o conteúdo editável vive em arquivos JSON (`storage/content/*.json`), lidos e gravados por `App\Support\ContentStore`. Não há tabela de usuários — apenas uma conta raiz por `.env` mais contas adicionais em `membros.json`.
- **Empacotamento:** todo o site (código + runtime PHP/Apache) é uma imagem Docker. Cada departamento/laboratório roda o **seu próprio container**, isolado dos demais.
- **Hospedagem alvo:** qualquer provedor com suporte a Docker — o próprio projeto já nasceu pensando em hospedagem comercial genérica (Hostinger), não em infraestrutura acadêmica especializada.
- **Painel administrativo:** uma tela por seção do site (Notícias, Editais, Eventos, Sobre, Serviços, Graduação, Pós-Graduação, Pessoal, Contato, Tema, Menu, Rodapé...), sem conceitos de CMS genérico como "content type", "view" ou "taxonomy".

## 1.2 UFOP Quick Start (`guiadesites.ufop.br`, ex.: `demat.ufop.br`)

Dados confirmados diretamente nos cabeçalhos HTTP e no HTML de `demat.ufop.br`:

```
Server: Apache/2.4.62 (Unix) OpenSSL/1.0.2k-fips
X-Powered-By: PHP/5.6.40
X-Generator: OpenScholar for Drupal 7 (http://theopenscholar.org)
```

- **Stack:** Drupal 7 + distribuição **OpenScholar** (plataforma acadêmica originalmente criada em Harvard, hoje mantida como projeto aberto).
- **Suporte da tecnologia base:** Drupal 7 saiu de suporte oficial em **janeiro de 2025**; PHP 5.6 está fora de suporte desde **dezembro de 2018**. O site real inspecionado roda ambos, hoje, em produção.
- **Provisionamento:** solicitação formal pelo portal **minhaUFOP**, aprovação da DTI em até **10 dias úteis**, domínio obrigatoriamente no formato `<nomedosite>.ufop.br`, com regras específicas de nomenclatura. Contas sem conteúdo publicado em até **60 dias** podem ser suspensas.
- **Suporte institucional:** Central de Atendimento da DTI, via chamado no sistema **GLPI**, e-mail ou telefone.
- **Modelo de edição:** baseado no vocabulário nativo do Drupal — nós (*nodes*), blocos (*boxes*), views, taxonomia — bastante flexível, porém exige entender esse modelo para editar o site.

## 1.3 Arizona Quickstart (`quickstart.arizona.edu`)

Dados confirmados no site oficial e no repositório `az-digital/az_quickstart` no GitHub:

- **Stack:** também Drupal, mas uma distribuição própria e muito mais recente — `az_quickstart`, descrita pelos mantenedores como *"UArizona's web content management system built with Drupal"*, com requisitos de sistema equivalentes aos do **Drupal 9**.
- **Desenvolvimento aberto:** projeto sob licença **GPL-2.0**, gerenciado via **Composer** (`az-quickstart-scaffolding`), com front-end próprio baseado em Bootstrap 4/5 (`arizona-bootstrap`).
- **Hospedagem recomendada:** **Pantheon**, uma plataforma comercial de hospedagem gerenciada especializada em Drupal/WordPress — "many important university sites are already there", segundo a documentação oficial.
- **Provisionamento:** formulário institucional ("Request Arizona Site") via ServiceNow.
- **Recursos:** tipos de conteúdo (páginas, eventos, notícias, pessoas/diretórios, publicações), elementos de página (acordeões, cards, galerias, split screen), formulários via integração com **Trellis**, treinamento formal de acessibilidade ("Building Accessible Websites with Quickstart").
- **Economia declarada:** a própria página cita **48% a 68% de economia** de tempo/custo frente a construir um site novo do zero — um indício de que a plataforma foi pensada para escala institucional grande, não para agilidade de um departamento isolado.

\newpage

# 2. Comparação técnica

| Critério | Nosso sistema | UFOP Quick Start | Arizona Quickstart |
|---|---|---|---|
| Base tecnológica | Laravel 13 + PHP 8.4 | Drupal 7 + OpenScholar | Drupal 9+ (`az_quickstart`) |
| Suporte oficial da tecnologia | Sim (versões correntes) | **Não** — Drupal 7 e PHP 5.6 fora de suporte | Sim (Drupal 9 é suportado) |
| Banco de dados | Nenhum (JSON em arquivo) | MySQL (Drupal) | MySQL/MariaDB (Drupal) |
| Empacotamento/deploy | 1 imagem Docker por site | Multisite institucional (DTI) | Composer + hospedagem gerenciada |
| Hospedagem | Qualquer provedor com Docker | Centralizada (DTI/minhaUFOP) | Pantheon (ou outra, por conta própria) |
| Provisionar um site novo | Copiar projeto, subir container | Solicitação formal, até 10 dias úteis | Formulário ServiceNow |
| Modelo de edição de conteúdo | Telas fixas, 1 tela por seção do site | Nodes / Views / Blocks (genérico Drupal) | Nodes / Views / Blocks (genérico Drupal) |
| Curva de aprendizado (secretaria/bolsista) | Baixa — sem jargão de CMS | Média/alta — vocabulário Drupal | Média/alta — vocabulário Drupal |
| Personalização visual | 34 paletas prontas, 1 tela, aplica na hora | Tema Drupal, exige know-how técnico | Tema Bootstrap, geralmente exige dev |
| Tipos de conteúdo | Fixos e específicos (Notícias, Editais, Eventos, Pessoal...) | Flexíveis, genéricos | Flexíveis, genéricos |
| Backup | 1 clique, `.zip` completo, cópia de segurança automática antes de restaurar | Não documentado publicamente | Depende do provedor de hospedagem |
| Multi-idioma | Não | Citado no guia oficial | Não confirmado na documentação pública |
| Renderização de fórmulas (MathJax) | Não | Sim (visto em `demat.ufop.br`) | Não confirmado |
| Suporte institucional formal | Equipe própria do departamento | GLPI / Central de Atendimento DTI | Treinamento + suporte de acessibilidade dedicado |
| Licença/abertura | Projeto interno | Não é código aberto do departamento | Código aberto (GPL-2.0) no GitHub |
| Custo de hospedagem | Baixo — qualquer VPS/hospedagem com Docker | Sem custo direto ao departamento | Pantheon é hospedagem comercial paga |

\newpage

# 3. Docker: o que muda de verdade no suporte e na operação

A diferença mais estrutural entre nosso sistema e as duas plataformas Drupal não está só na tecnologia web — está em **como o site é empacotado, hospedado e mantido**. Isso é o Docker.

## 3.1 Portabilidade total

O site inteiro — runtime PHP, Apache, dependências, código — é uma **imagem Docker**. Ela roda de forma idêntica em qualquer máquina com Docker instalado: um notebook local, um VPS de US$ 5/mês, ou um servidor da própria universidade. Não existe dependência de uma plataforma institucional específica (como o multisite da DTI ou o Pantheon do Arizona) para o site existir. Migrar de host é, na prática, copiar a pasta do projeto e rodar `docker compose up -d --build` no destino.

## 3.2 Isolamento real entre sites

Cada departamento/laboratório tem o **seu próprio container**, com seu próprio processo PHP e seu próprio Apache. Um pico de tráfego, um erro de configuração ou uma falha de segurança em um site **não vaza para os outros** — ao contrário de uma instalação multisite tradicional do Drupal, em que vários sites compartilham o mesmo código-base e, frequentemente, o mesmo banco de dados/cluster.

## 3.3 Atualização de versão sem travar no passado

É por isso que `demat.ufop.br` ainda roda PHP 5.6 e Drupal 7 hoje: numa instalação multisite antiga, atualizar o PHP ou o Drupal de um site pode quebrar módulos de outro site que compartilha a mesma base — então, na prática, ninguém atualiza. Com Docker, atualizar a versão do PHP é **trocar uma linha no Dockerfile e reconstruir a imagem**; se algo quebrar, o container antigo continua disponível até a nova versão ser validada. O risco de uma atualização fica contido a um único site, não à instalação inteira.

## 3.4 Backup e recuperação sob controle do próprio departamento

Os volumes Docker (`storage/content`, `storage/uploads`, `storage/backups-seguranca`) separam **dados** de **aplicação**. Isso é o que permite o botão de backup em `/admin/backup` — baixar um `.zip` com tudo, restaurar com um clique, com cópia de segurança automática antes de qualquer restauração. Numa plataforma centralizada, o backup depende da política do provedor (DTI ou Pantheon); aqui, o próprio departamento tem esse controle, sem depender de terceiros.

## 3.5 Suporte técnico com superfície menor

Sustentar uma instalação Drupal — mesmo a versão mais moderna do Arizona Quickstart — exige conhecimento de módulos, temas, views, atualizações de composer, banco de dados. Sustentar este sistema exige saber rodar comandos `docker compose` e, na pior hipótese, reconstruir a imagem do zero a partir do `Dockerfile` — o conteúdo sobrevive porque mora nos volumes, não no container. Isso reduz bastante o time-to-fix quando algo dá errado, e reduz o perfil de quem precisa ser chamado para resolver.

## 3.6 O outro lado da moeda

Docker não é vantagem em tudo. Ao trocar uma plataforma centralizada (DTI, Pantheon) por um container autônomo, o departamento também assume responsabilidades que antes eram de terceiros: monitorar se o container está no ar, aplicar as atualizações de segurança do próprio Dockerfile, garantir que os volumes estão sendo de fato salvos em disco persistente no host de produção. Não há uma equipe central de plantão olhando esse container 24 horas por dia — é a troca de **suporte institucional garantido** por **independência e controle direto**.

\newpage

# 4. Quando cada abordagem faz sentido

- **Nosso sistema** é a escolha certa para um site institucional de departamento/laboratório com um conjunto de seções bem definido (notícias, editais, equipe, contato) e uma equipe pequena e não-técnica cuidando do conteúdo no dia a dia — troca flexibilidade genérica de CMS por simplicidade, segurança por superfície reduzida, e independência de infraestrutura por responsabilidade de manutenção própria.
- **UFOP Quick Start** (na versão hoje em produção, Drupal 7/OpenScholar) carrega um débito técnico real — tecnologia sem suporte oficial há anos — mas oferece a vantagem de já estar dentro da estrutura institucional oficial, com suporte formal via DTI.
- **Arizona Quickstart** mostra que a mesma ideia de "Quick Start" institucional pode ser feita com tecnologia atual (Drupal 9+, Composer, hospedagem gerenciada) — é o parâmetro de como uma universidade de porte comparável resolveu o mesmo problema de forma mais moderna que a versão vista em `demat.ufop.br`, ao custo de depender de uma plataforma comercial de hospedagem (Pantheon) e de um modelo de conteúdo mais genérico/complexo para quem edita.
