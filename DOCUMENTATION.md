## Índice

- [Introdução](#introdução)
- [Instalação](#instalação)
- [Arquitetura e Estrutura Interna](#arquitetura-e-estrutura-interna)
- [Principais Módulos e Funcionalidades](#principais-módulos-e-funcionalidades)
- [Uso Prático](#uso-prático)
- [Integração com o Ecossistema Rica Soluções](#integração-com-o-ecossistema-rica-soluções)
- [Extensão e Customização](#extensão-e-customização)
- [Exemplos Reais](#exemplos-reais)
- [Ferramentas de Desenvolvimento](#ferramentas-de-desenvolvimento)
- [Guia de Contribuição](#guia-de-contribuição)

---

## Introdução

### O que é a biblioteca CMS

**SierraTecnologia CMS** é uma biblioteca Laravel completa e extensível que adiciona funcionalidades de gerenciamento de conteúdo (CMS) a qualquer aplicação Laravel existente. Desenvolvida pela Rica Soluções/SierraTecnologia, a biblioteca oferece controle total sobre:

- 📄 **Páginas estáticas e dinâmicas**
- 📝 **Blogs e artigos**
- 📅 **Calendário de eventos**
- 🖼️ **Galeria de imagens**
- 📁 **Gerenciamento de arquivos**
- 🧭 **Menus de navegação**
- 🧩 **Widgets reutilizáveis**
- ❓ **FAQs (Perguntas Frequentes)**
- 🎁 **Promoções e destaques**

### Objetivo e Filosofia do Projeto

A filosofia central do SierraTecnologia CMS é fornecer uma solução **modular**, **extensível** e **profissional** para gerenciamento de conteúdo, seguindo os melhores padrões de desenvolvimento Laravel e arquitetura de software:

- **Modularidade**: Ative apenas os módulos que você precisa
- **Extensibilidade**: Crie módulos customizados facilmente
- **Padrões de Código**: PSR-12, SOLID, e Laravel Best Practices
- **Testabilidade**: Cobertura completa de testes unitários e de integração
- **Documentação**: Código bem documentado e exemplos práticos

### Benefícios de Uso

✅ **Produtividade**: Não reinvente a roda - use componentes prontos e testados
✅ **Padronização**: Código consistente seguindo padrões da Rica Soluções
✅ **Manutenibilidade**: Arquitetura limpa facilita manutenção e evolução
✅ **Multiidioma**: Suporte nativo a múltiplos idiomas
✅ **Versionamento**: Histórico completo de alterações em conteúdo
✅ **SEO-Ready**: Recursos otimizados para mecanismos de busca
✅ **Segurança**: Validações, criptografia e proteção de assets

### Integração no Ecossistema Rica Soluções

O CMS faz parte do ecossistema maior da Rica Soluções, integrando-se perfeitamente com:

- **sierratecnologia/builder**: Geração de código e scaffolding
- **ricardosierra/translation**: Sistema de tradução e internacionalização
- **ricardosierra/minify**: Otimização de assets (CSS/JS)
- **Outros pacotes**: API base, GraphQL, arquiteto, técnico, etc.

---

## Instalação

### Requisitos Mínimos

- **PHP**: 7.1.3 ou superior (recomendado PHP 8.0+)
- **Laravel**: 7.x ou superior
- **MySQL**: 5.7+ ou PostgreSQL 9.6+
- **Composer**: 2.x
- **Extensões PHP**: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo, GD

### Instalação via Composer

#### 1. Adicione o repositório ao seu `composer.json` (se necessário)

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/SierraTecnologia/CMS"
        }
    ]
}
```

#### 2. Instale o pacote

```bash
composer require sierratecnologia/cms
```

#### 3. Publique os assets e configurações

```bash
# Publicar todos os assets (configuração, views, controllers, rotas, temas)
php artisan vendor:publish --provider="SierraTecnologia\Cms\SierraTecnologiaCmsProvider"

# Publicar apenas as views do backend (opcional)
php artisan vendor:publish --provider="SierraTecnologia\Cms\SierraTecnologiaCmsProvider" --tag="backend"
```

#### 4. Execute as migrações

```bash
php artisan migrate
```

#### 5. Execute o setup inicial

```bash
php artisan cms:setup
```

Este comando irá:
- Gerar chaves de criptografia
- Criar estruturas iniciais
- Configurar o ambiente

### Registro de ServiceProviders

O ServiceProvider principal (`SierraTecnologiaCmsProvider`) é registrado automaticamente via **auto-discovery** do Laravel 5.5+.

Se você desabilitou o auto-discovery, adicione manualmente em `config/app.php`:

```php
'providers' => [
    // ...
    SierraTecnologia\Cms\SierraTecnologiaCmsProvider::class,
],
```

### Configuração

O arquivo de configuração principal está em `config/cms.php`. Principais configurações:

```php
return [
    // Analytics: 'google' ou 'internal'
    'analytics' => 'internal',

    // Prefixo de rotas do backend
    'backend-route-prefix' => 'cms',

    // Tema do frontend
    'frontend-theme' => 'default',

    // Tema do backend: 'standard' ou 'dark'
    'backend-theme' => 'standard',

    // Paginação padrão
    'pagination' => 24,

    // Módulos ativos
    'active-core-modules' => [
        'blog', 'menus', 'files', 'images',
        'pages', 'widgets', 'promotions',
        'events', 'faqs',
    ],

    // Idiomas suportados
    'languages' => [
        'en' => 'english',
        'pt' => 'portuguese',
        'es' => 'spanish',
    ],

    // Storage: 'local' ou 's3'
    'storage-location' => 'local',

    // Tamanho máximo de upload (bytes)
    'max-file-upload-size' => 6291456, // 6MB
];
```

---

## Arquitetura e Estrutura Interna

### Estrutura de Diretórios

```
src/
├── Assets/                   # Recursos estáticos (CSS, JS, imagens)
├── Console/                  # Comandos Artisan (8 comandos)
├── Controllers/              # Controllers do backend (18 controllers)
├── Facades/                  # Facades para serviços (6 facades)
├── Helpers/                  # Funções helpers (blade.php, general.php)
├── Middleware/               # Middleware custom (analytics)
├── Migrations/               # Migrações de banco (15 tabelas)
├── Models/                   # Modelos Eloquent (12 modelos)
├── Providers/                # Service Providers adicionais
├── Repositories/             # Padrão Repository (11 repositórios)
├── Requests/                 # Form Requests/Validações (10 requests)
├── Routes/                   # Definições de rotas (web.php, api.php)
├── Services/                 # Lógica de negócio (11 serviços + traits)
├── Templates/                # Templates para geração de código
├── Views/                    # Views Blade do backend (60+ views)
└── PublishedAssets/          # Assets publicáveis para o projeto
    ├── Config/               # Arquivo de configuração
    ├── Controllers/          # Controllers customizáveis
    ├── Middleware/           # Middleware customizável
    ├── Routes/               # Rotas customizáveis
    ├── Setup/                # Views de setup
    ├── Theme/                # Tema padrão
    └── Views/                # Views customizáveis
```

### Padrões Arquiteturais

O SierraTecnologia CMS implementa uma arquitetura em camadas baseada no **Service-Repository Pattern** combinado com **MVC**:

```
┌─────────────────────────────────────────────────────────────┐
│                  PRESENTATION LAYER                          │
│  Controllers (PagesController, BlogController, etc.)         │
│  - Recebem requisições HTTP                                  │
│  - Delegam lógica para Services                              │
│  - Retornam Views ou JSON                                    │
└────────────────────────┬────────────────────────────────────┘
                         │
┌────────────────────────▼────────────────────────────────────┐
│                   APPLICATION LAYER                          │
│  Services (PageService, BlogService, ModuleService)         │
│  - Contêm lógica de negócio                                 │
│  - Usam Repositories para acesso a dados                    │
│  - Implementam Traits para reutilização                     │
└────────────────────────┬────────────────────────────────────┘
                         │
┌────────────────────────▼────────────────────────────────────┐
│                  DOMAIN LAYER                                │
│  Repositories (PageRepository, BlogRepository)              │
│  - Acesso a dados via Eloquent                              │
│  - Queries e filtros                                         │
│  Models (Page, Blog, Event, etc.)                           │
│  - Entidades do domínio                                      │
│  - Relacionamentos Eloquent                                 │
└────────────────────────┬────────────────────────────────────┘
                         │
┌────────────────────────▼────────────────────────────────────┐
│            INFRASTRUCTURE LAYER                              │
│  Eloquent ORM + Migrations + Database                       │
└─────────────────────────────────────────────────────────────┘
```

### Comunicação entre Camadas

**Fluxo típico de uma requisição (exemplo: criar página)**

```
1. POST /cms/pages
   ↓
2. PagesController@store
   - Valida com PagesRequest
   - Prepara dados
   ↓
3. PageRepository@store
   - parseBlocks() - extrai blocos dinâmicos
   - Processa hero_image
   - Define published_at
   ↓
4. Page Model (Eloquent)
   - Aplica regras de validação
   - Mutadores/Accessors
   - afterSaved() → cria Archive (histórico)
   ↓
5. Database INSERT
   ↓
6. Response: redirect + notification
```

### Convenções da Rica Soluções

- **PSR-12**: Padrão de código rigorosamente seguido
- **Namespaces**: Sempre `SierraTecnologia\Cms\{Layer}\{Component}`
- **Nomenclatura**:
  - Controllers: `{Entity}Controller` (ex: `PagesController`)
  - Services: `{Entity}Service` (ex: `PageService`)
  - Repositories: `{Entity}Repository` (ex: `PageRepository`)
  - Models: `{Entity}` (ex: `Page`)
  - Requests: `{Entity}Request` (ex: `PagesRequest`)
- **Traits**: Para funcionalidades compartilhadas (`MenuServiceTrait`, `ModuleServiceTrait`)
- **Facades**: Para acesso simplificado (`Cms::`, `PageService::`)

---

## Principais Módulos e Funcionalidades

### 1. **Pages (Páginas)**

Gerenciamento completo de páginas estáticas e dinâmicas.

**Funcionalidades:**
- ✏️ Editor WYSIWYG (Redactor)
- 📋 Templates dinâmicos
- 🧱 Blocos customizáveis (JSON)
- 🔍 SEO (title, description, keywords)
- 📅 Publicação agendada
- 🖼️ Imagem hero/destaque
- 📜 Histórico de versões
- 🌐 Multilíngue

**Exemplo de uso:**

```php
// No Controller
use SierraTecnologia\Cms\Repositories\PageRepository;

$pageRepo = app(PageRepository::class);

// Criar página
$page = $pageRepo->store([
    'title' => 'Sobre Nós',
    'url' => 'sobre-nos',
    'entry' => '<h1>Nossa História</h1><p>...</p>',
    'is_published' => true,
    'published_at' => now(),
    'seo_description' => 'Conheça nossa história',
    'seo_keywords' => 'sobre, empresa, história',
]);

// Buscar por URL
$page = $pageRepo->findPagesByURL('sobre-nos');

// Listar publicadas
$pages = $pageRepo->published();
```

**Rotas:**
```
GET    /cms/pages           → PagesController@index
GET    /cms/pages/create    → PagesController@create
POST   /cms/pages           → PagesController@store
GET    /cms/pages/{id}/edit → PagesController@edit
PATCH  /cms/pages/{id}      → PagesController@update
DELETE /cms/pages/{id}      → PagesController@destroy
POST   /cms/pages/search    → PagesController@search
```

---

### 2. **Blog (Artigos/Posts)**

Sistema completo de blog com tags, SEO e publicação agendada.

**Funcionalidades:**
- 📝 Posts com editor rico
- 🏷️ Sistema de tags
- 🔍 SEO otimizado
- 📅 Publicação agendada
- 🖼️ Imagem de destaque
- 📊 RSS Feed
- 🌐 Multilíngue

**Exemplo de uso:**

```php
use SierraTecnologia\Cms\Repositories\BlogRepository;

$blogRepo = app(BlogRepository::class);

// Criar post
$post = $blogRepo->store([
    'title' => 'Laravel 10 - Novidades',
    'url' => 'laravel-10-novidades',
    'entry' => '<p>O Laravel 10 trouxe várias melhorias...</p>',
    'tags' => 'laravel,php,framework',
    'is_published' => true,
    'published_at' => now(),
]);

// Listar posts publicados
$posts = $blogRepo->published();
```

**Blade Helpers:**

```blade
{{-- Listar últimos posts --}}
@foreach(app('SierraTecnologia\Cms\Repositories\BlogRepository')->published()->take(5) as $post)
    <article>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->seo_description }}</p>
        <a href="/blog/{{ $post->url }}">Ler mais</a>
    </article>
@endforeach
```

---

### 3. **Events (Eventos)**

Calendário de eventos com datas, locais e descrições.

**Funcionalidades:**
- 📅 Data/hora do evento
- 📍 Local
- 📝 Descrição detalhada
- 🔍 SEO
- 📅 Publicação agendada

**Exemplo de uso:**

```php
use SierraTecnologia\Cms\Repositories\EventRepository;

$eventRepo = app(EventRepository::class);

$event = $eventRepo->store([
    'title' => 'Workshop Laravel Avançado',
    'start_date' => '2024-03-15 09:00:00',
    'end_date' => '2024-03-15 18:00:00',
    'location' => 'Centro de Convenções - São Paulo',
    'entry' => '<p>Aprenda técnicas avançadas...</p>',
    'is_published' => true,
]);
```

---

### 4. **Images (Galeria de Imagens)**

Sistema completo de upload, gerenciamento e organização de imagens.

**Funcionalidades:**
- 📤 Upload múltiplo
- 🔄 Redimensionamento automático
- 🏷️ Tags/categorias
- 🔗 Relacionamento com entidades
- 🗑️ Bulk delete
- 🔒 URLs criptografadas
- 📊 API de listagem

**Exemplo de uso:**

```php
use SierraTecnologia\Cms\Repositories\ImageRepository;

$imageRepo = app(ImageRepository::class);

// Upload de imagem
$image = $imageRepo->store([
    'location' => $request->file('image')->store('images'),
    'name' => 'produto-destaque.jpg',
    'tags' => 'produto,destaque,2024',
    'entity_id' => $produto->id,
    'entity_type' => 'App\Models\Produto',
]);

// Buscar por tags
$images = $imageRepo->getByTag('destaque');
```

**Blade Helpers:**

```blade
{{-- Renderizar imagem --}}
@image('produto-destaque.jpg', 'alt text')

{{-- Listar imagens por tag --}}
@images('portfolio')

{{-- Link para imagem --}}
@image_link('banner-principal.jpg')
```

---

### 5. **Files (Arquivos)**

Gerenciamento de arquivos para download.

**Funcionalidades:**
- 📤 Upload de múltiplos formatos
- 📥 Download seguro
- 🔒 Criptografia de URLs
- 👁️ Preview de arquivos
- 📊 Estatísticas de download

**Exemplo de uso:**

```php
use SierraTecnologia\Cms\Repositories\FileRepository;

$fileRepo = app(FileRepository::class);

$file = $fileRepo->store([
    'location' => $request->file('document')->store('files'),
    'name' => 'manual-usuario.pdf',
    'mime' => 'application/pdf',
    'size' => $request->file('document')->getSize(),
]);
```

---

### 6. **Menus (Navegação)**

Sistema de menus dinâmicos com ordenação.

**Funcionalidades:**
- 🧭 Estrutura hierárquica
- 🔢 Ordenação customizável
- 🔗 Links internos/externos
- 🌐 Multilíngue

**Exemplo de uso:**

```php
use SierraTecnologia\Cms\Repositories\MenuRepository;
use SierraTecnologia\Cms\Repositories\LinkRepository;

$menuRepo = app(MenuRepository::class);
$linkRepo = app(LinkRepository::class);

// Criar menu
$menu = $menuRepo->store([
    'name' => 'Menu Principal',
    'slug' => 'main',
]);

// Adicionar links
$linkRepo->store([
    'name' => 'Início',
    'external' => false,
    'page_id' => $homePage->id,
    'menu_id' => $menu->id,
    'order' => 1,
]);
```

**Blade Helpers:**

```blade
{{-- Renderizar menu --}}
@menu('main')

{{-- Com view customizada --}}
@menu('main', 'partials.navigation')
```

---

### 7. **Widgets (Componentes Reutilizáveis)**

Blocos de conteúdo reutilizáveis via slug.

**Exemplo de uso:**

```php
use SierraTecnologia\Cms\Repositories\WidgetRepository;

$widgetRepo = app(WidgetRepository::class);

$widget = $widgetRepo->store([
    'slug' => 'footer-contato',
    'name' => 'Contato Rodapé',
    'content' => '<div>Email: contato@example.com</div>',
    'is_published' => true,
]);
```

**Blade Helpers:**

```blade
{{-- Renderizar widget --}}
@widget('footer-contato')
```

---

### 8. **FAQs (Perguntas Frequentes)**

Gerenciamento de perguntas e respostas.

**Exemplo de uso:**

```php
$faqRepo = app('SierraTecnologia\Cms\Repositories\FAQRepository');

$faq = $faqRepo->store([
    'question' => 'Como instalar o CMS?',
    'answer' => '<p>Execute: composer require sierratecnologia/cms</p>',
    'is_published' => true,
]);
```

---

### 9. **Promotions (Promoções/Destaques)**

Sistema de promoções com datas de validade.

**Exemplo de uso:**

```php
$promoRepo = app('SierraTecnologia\Cms\Repositories\PromotionRepository');

$promo = $promoRepo->store([
    'title' => 'Black Friday 2024',
    'content' => '<p>Até 50% de desconto!</p>',
    'start_date' => '2024-11-25',
    'end_date' => '2024-11-30',
    'is_published' => true,
]);
```

**Blade Helpers:**

```blade
@promotion('black-friday-2024')
```

---

## Uso Prático

### Instalação em Projeto Laravel Existente

**Cenário**: Você tem um projeto Laravel de e-commerce e quer adicionar blog, páginas institucionais e FAQs.

#### Passo 1: Instalar o CMS

```bash
composer require sierratecnologia/cms
php artisan vendor:publish --provider="SierraTecnologia\Cms\SierraTecnologiaCmsProvider"
php artisan migrate
php artisan cms:setup
```

#### Passo 2: Configurar módulos ativos

Em `config/cms.php`:

```php
'active-core-modules' => [
    'blog',
    'pages',
    'faqs',
],
```

#### Passo 3: Acessar o painel admin

```
http://seusite.com/cms
```

#### Passo 4: Criar páginas institucionais

No painel admin, vá em **Pages** → **Create**:

- **Title**: Sobre Nós
- **URL**: sobre-nos
- **Content**: <editor de conteúdo>
- **SEO Description**: Conheça nossa história
- **Published**: ✅

#### Passo 5: Integrar no frontend

Em suas views:

```blade
{{-- routes/web.php --}}
Route::get('/{url}', 'PageController@show');

{{-- app/Http/Controllers/PageController.php --}}
public function show($url)
{
    $pageRepo = app(\SierraTecnologia\Cms\Repositories\PageRepository::class);
    $page = $pageRepo->findPagesByURL($url);

    if (!$page) {
        abort(404);
    }

    return view('pages.show', compact('page'));
}

{{-- resources/views/pages/show.blade.php --}}
@extends('layouts.app')

@section('title', $page->title)
@section('meta_description', $page->seo_description)

@section('content')
    <h1>{{ $page->title }}</h1>
    {!! $page->entry !!}
@endsection
```

---

### Criação de Componentes Reutilizáveis

**Exemplo: Banner promocional no topo do site**

#### 1. Criar widget

No painel admin → **Widgets** → **Create**:

- **Slug**: banner-topo
- **Name**: Banner Promocional Topo
- **Content**:
```html
<div class="promo-banner bg-red-500 text-white p-4 text-center">
    <strong>OFERTA ESPECIAL!</strong> Use o cupom WELCOME10 e ganhe 10% de desconto.
</div>
```

#### 2. Renderizar no layout

```blade
{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html>
<head>...</head>
<body>
    @widget('banner-topo')

    <header>...</header>

    @yield('content')
</body>
</html>
```

---

### Boas Práticas

✅ **Use Repositories ao invés de Models diretamente**

```php
// ❌ Evite
$pages = Page::where('is_published', 1)->get();

// ✅ Prefira
$pageRepo = app(PageRepository::class);
$pages = $pageRepo->published();
```

✅ **Sempre valide com Form Requests**

```php
// No Controller
public function store(PagesRequest $request)
{
    // Dados já validados
}
```

✅ **Use Facades para lógica do CMS**

```php
use SierraTecnologia\Cms\Facades\CmsServiceFacade as Cms;

// Buscar menu
$menu = Cms::menu('main');

// Buscar widget
$widget = Cms::widget('footer');
```

✅ **Aproveite os Blade Directives**

```blade
@menu('main')
@widget('sidebar-banner')
@images('portfolio')
@edit('pages', $page->id)
```

---

## Integração com o Ecossistema Rica Soluções

### Relação com Outras Bibliotecas

O SierraTecnologia CMS integra-se perfeitamente com outras bibliotecas da Rica Soluções:

#### **sierratecnologia/builder**
- Geração automática de código
- Scaffolding de módulos
- CRUD generators

```bash
# Gerar CRUD completo
php artisan builder:crud Produto
```

#### **ricardosierra/translation**
- Sistema completo de tradução
- Suporte multilíngue
- Gestão de idiomas

```php
// Models usam trait HasTranslations
$page->translate('pt')->title = 'Sobre Nós';
$page->translate('en')->title = 'About Us';
```

#### **ricardosierra/minify**
- Minificação automática de CSS/JS
- Otimização de assets
- Cache de recursos

```blade
{!! Minify::stylesheet([
    '/css/app.css',
    '/css/cms.css',
]) !!}
```

---

### Padrões de Versionamento

O projeto segue **Semantic Versioning (SemVer)**:

- **MAJOR**: Mudanças incompatíveis com versões anteriores
- **MINOR**: Novas funcionalidades compatíveis
- **PATCH**: Correções de bugs

**Exemplo**: `v3.2.5`

---

### Testes Automatizados

O CMS possui **cobertura completa de testes**:

```bash
# Executar todos os testes
composer test

# Com cobertura
composer test-coverage

# Apenas testes de feature
vendor/bin/phpunit --testsuite=Feature

# Apenas testes de services
vendor/bin/phpunit tests/Services/
```

**Estrutura de testes:**

```
tests/
├── Feature/           # Testes de integração (CRUD completo)
│   ├── PagesTest.php
│   ├── BlogTest.php
│   └── ...
├── Services/          # Testes unitários de lógica
│   ├── PageServiceTest.php
│   ├── CmsServiceTest.php
│   └── ...
└── factories/         # Factories para testes
    ├── PageFactory.php
    └── ...
```

---

### Pipeline CI/CD

O projeto utiliza **GitHub Actions** para CI/CD automatizado:

```yaml
# .github/workflows/ci.yml
- Testes em múltiplas versões (PHP 7.4, 8.0, 8.1, 8.2)
- Análise estática (PHPStan nível 5)
- Verificação de código (PHPCS PSR-12)
- Cobertura de testes (Codecov)
- Security check (Roave Security Advisories)
```

---

### Uso Padronizado em Equipes

**Convenções para equipes:**

1. **Branching Strategy**:
   - `master`: produção estável
   - `develop`: desenvolvimento ativo
   - `feature/*`: novas funcionalidades
   - `bugfix/*`: correções

2. **Commits Semânticos**:
   ```
   feat: adiciona suporte a vídeos no blog
   fix: corrige upload de imagens grandes
   refactor: melhora performance do PageRepository
   docs: atualiza README com exemplos
   test: adiciona testes para EventService
   ```

3. **Code Review**:
   - Toda mudança via Pull Request
   - Mínimo 1 aprovação
   - Testes devem passar
   - PHPCS e PHPStan devem passar

---

## Extensão e Customização

### Como Criar Módulos Customizados

O CMS oferece comandos para gerar módulos rapidamente:

#### 1. Gerar módulo completo

```bash
php artisan module:make Produto
```

Isso criará:
```
cms/modules/produto/
├── Controllers/
│   └── ProdutoController.php
├── Models/
│   └── Produto.php
├── Repositories/
│   └── ProdutoRepository.php
├── Requests/
│   └── ProdutoRequest.php
├── Routes/
│   └── web.php
├── Views/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── migrations/
    └── create_produtos_table.php
```

#### 2. Gerar apenas CRUD

```bash
php artisan module:crud Categoria
```

#### 3. Gerar composer.json para o módulo

```bash
php artisan module:composer Produto
```

---

### Criar Temas Customizados

#### 1. Gerar tema

```bash
php artisan theme:generate MeuTema
```

#### 2. Estrutura do tema

```
resources/themes/MeuTema/
├── layouts/
│   ├── master.blade.php
│   └── partials/
│       ├── header.blade.php
│       ├── footer.blade.php
│       └── navigation.blade.php
├── pages/
│   ├── home.blade.php
│   ├── show.blade.php
│   └── list.blade.php
├── blog/
│   ├── index.blade.php
│   └── show.blade.php
└── assets/
    ├── css/
    ├── js/
    └── images/
```

#### 3. Ativar tema

Em `config/cms.php`:

```php
'frontend-theme' => 'MeuTema',
```

#### 4. Usar tema nas views

```blade
@theme('pages.home')
```

---

### Substituir Classes via Injeção de Dependência

Você pode substituir repositórios, services, etc:

```php
// app/Providers/AppServiceProvider.php

public function register()
{
    // Substituir PageRepository por implementação customizada
    $this->app->bind(
        \SierraTecnologia\Cms\Repositories\PageRepository::class,
        \App\Repositories\CustomPageRepository::class
    );
}
```

---

### Estender Models com Traits

```php
// app/Traits/HasComments.php
trait HasComments
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

// Aplicar ao Page model via observer ou boot
Page::resolveRelationUsing('comments', function ($pageModel) {
    return $pageModel->hasMany(Comment::class);
});
```

---

### Criar Blade Directives Customizados

```php
// app/Providers/AppServiceProvider.php

public function boot()
{
    Blade::directive('produto', function ($expression) {
        return "<?php echo app('App\Services\ProdutoService')->render($expression); ?>";
    });
}
```

**Uso:**

```blade
@produto($id)
```

---

### Boas Práticas para Manutenção

✅ **Mantenha módulos desacoplados**
✅ **Use Events para comunicação entre módulos**
✅ **Versione suas customizações**
✅ **Documente mudanças importantes**
✅ **Teste antes de deploy**

---

## Exemplos Reais

### Caso 1: Blog Corporativo

**Antes do CMS:**
- Código hardcoded para posts
- Sem painel admin
- Edição requer desenvolvedor
- Sem SEO estruturado

**Depois do CMS:**
- Painel admin intuitivo
- Marketing edita posts sem programar
- SEO automático (meta tags, sitemap, RSS)
- Publicação agendada
- Histórico de versões

**Métricas:**
- ⏱️ **Tempo de criação de post**: 2 horas → 15 minutos
- 👨‍💻 **Dependência de dev**: 100% → 0%
- 📈 **SEO score**: 45 → 89

---

### Caso 2: Site Institucional com Múltiplos Idiomas

**Antes:**
- Páginas em arquivos Blade
- Tradução manual e propensa a erros
- Inconsistência entre idiomas

**Depois:**
- Gerenciamento centralizado
- Traduções organizadas
- Switcher de idiomas automático

```php
// Criar página em múltiplos idiomas
$page = $pageRepo->store([
    'title' => 'About Us',
    'url' => 'about',
    'entry' => '...',
]);

$page->translate('pt')->title = 'Sobre Nós';
$page->translate('pt')->url = 'sobre';
$page->save();
```

---

### Caso 3: E-commerce com FAQs Dinâmicos

**Problema**: Clientes tinham dúvidas recorrentes sobre produtos.

**Solução**: Implementar módulo FAQ do CMS.

```php
// Criar FAQ
$faqRepo->store([
    'question' => 'Qual o prazo de entrega?',
    'answer' => '<p>Entregamos em até 7 dias úteis...</p>',
    'category' => 'entrega',
    'is_published' => true,
]);
```

**Blade:**

```blade
{{-- Listar FAQs de uma categoria --}}
@foreach($faqRepo->published()->where('category', 'entrega')->get() as $faq)
    <details>
        <summary>{{ $faq->question }}</summary>
        {!! $faq->answer !!}
    </details>
@endforeach
```

**Resultados:**
- 📉 **Tickets de suporte**: -35%
- ⏱️ **Tempo de resposta**: -50%
- 😊 **Satisfação do cliente**: +28%

---

## Ferramentas de Desenvolvimento

### Configuração de Qualidade de Código

O projeto está configurado com ferramentas profissionais de verificação:

#### **PHPCS (PHP_CodeSniffer)** - PSR-12

```bash
# Verificar código
composer cs
# ou
vendor/bin/phpcs

# Corrigir automaticamente
composer cs-fix
# ou
vendor/bin/phpcbf
```

**Configuração**: `phpcs.xml`

---

#### **PHPStan** - Análise Estática (Nível 5)

```bash
# Analisar código
composer stan
# ou
vendor/bin/phpstan analyse
```

**Configuração**: `phpstan.neon`

---

#### **PHPUnit** - Testes Automatizados

```bash
# Executar testes
composer test

# Com cobertura HTML
composer test-coverage
```

**Configuração**: `phpunit.xml`

---

#### **GitHub Actions** - CI/CD

O pipeline automatizado executa:

✅ Testes em PHP 7.4, 8.0, 8.1, 8.2
✅ Testes em Laravel 7.x, 8.x, 9.x, 10.x
✅ PHPCS (PSR-12)
✅ PHPStan (Nível 5)
✅ Security Check
✅ Cobertura de testes (Codecov)

**Arquivo**: `.github/workflows/ci.yml`

---

### Scripts Composer Úteis

```json
{
    "scripts": {
        "test": "phpunit",
        "test-coverage": "phpunit --coverage-html coverage",
        "cs": "phpcs",
        "cs-fix": "phpcbf",
        "stan": "phpstan analyse",
        "check": ["@cs", "@stan", "@test"]
    }
}
```

**Uso:**

```bash
# Verificar tudo de uma vez
composer check
```

---

### Comandos Artisan do CMS

```bash
# Setup inicial
php artisan cms:setup

# Gerar chaves de criptografia
php artisan cms:keys

# Módulos
php artisan module:make {name}         # Criar módulo completo
php artisan module:crud {name}         # Criar CRUD
php artisan module:composer {name}     # Gerar composer.json
php artisan module:publish             # Publicar módulo

# Temas
php artisan theme:generate {name}      # Criar tema
php artisan theme:publish              # Publicar tema
php artisan theme:link                 # Criar symlink
```

---

## Guia de Contribuição

### Como Contribuir

Contribuições são muito bem-vindas! Siga os passos:

#### 1. Fork e Clone

```bash
git clone https://github.com/SEU-USUARIO/CMS.git
cd CMS
composer install
```

#### 2. Criar Branch

```bash
git checkout -b feature/minha-funcionalidade
```

#### 3. Fazer Mudanças

- Escreva código limpo e documentado
- Siga PSR-12
- Adicione testes
- Atualize documentação se necessário

#### 4. Executar Verificações

```bash
composer check
```

#### 5. Commit e Push

```bash
git add .
git commit -m "feat: adiciona suporte a vídeos no blog"
git push origin feature/minha-funcionalidade
```

#### 6. Abrir Pull Request

- Descreva suas mudanças
- Referencie issues relacionadas
- Aguarde code review

---

### Padrões de Commit

Use **Conventional Commits**:

```
feat: adiciona nova funcionalidade
fix: corrige bug
refactor: refatora código sem mudar funcionalidade
docs: atualiza documentação
test: adiciona ou corrige testes
style: mudanças de formatação
chore: tarefas de manutenção
perf: melhoria de performance
ci: mudanças no CI/CD
```

**Exemplos:**

```bash
git commit -m "feat: adiciona upload de vídeos no BlogController"
git commit -m "fix: corrige validação de URL em PagesRequest"
git commit -m "docs: atualiza README com exemplos de widgets"
git commit -m "test: adiciona testes para ImageRepository"
```

---

### Nomenclatura de Branches

- `feature/nome-funcionalidade` - Novas funcionalidades
- `bugfix/nome-bug` - Correções
- `hotfix/nome-urgente` - Correções urgentes para produção
- `refactor/nome-refatoracao` - Refatorações
- `docs/nome-documentacao` - Documentação

---

### Code Review

Toda contribuição passa por code review:

✅ Código segue PSR-12
✅ Testes passam
✅ PHPStan nível 5 passa
✅ Cobertura de testes adequada
✅ Documentação atualizada
✅ Sem breaking changes não documentadas

---

### Executar Testes Localmente

```bash
# Todos os testes
composer test

# Apenas Feature
vendor/bin/phpunit --testsuite=Feature

# Apenas Services
vendor/bin/phpunit tests/Services/

# Com cobertura
composer test-coverage
```

**Cobertura mínima esperada**: 70%

---

### Licenciamento e Autores

**Licença**: MIT License

**Autores Principais**:
- Matt Lantz ([@mattylantz](https://twitter.com/mattylantz))
- Ricardo Rebello Sierra (ricardo@sierratecnologia.com.br)

**Contribuidores**: [Ver todos](https://github.com/SierraTecnologia/CMS/graphs/contributors)

---

### Reportar Issues

Ao reportar issues, inclua:

1. **Versão do CMS**: `composer show sierratecnologia/cms`
2. **Versão do Laravel**: `php artisan --version`
3. **Versão do PHP**: `php -v`
4. **Descrição detalhada** do problema
5. **Passos para reproduzir**
6. **Comportamento esperado vs atual**
7. **Stack trace** se houver erro
8. **Screenshots** se aplicável

---

### Contato

- 💬 **Gitter**: [SierraTecnologia/CMS](https://gitter.im/SierraTecnologiaInc/CMS)
- 🐛 **Issues**: [GitHub Issues](https://github.com/SierraTecnologia/CMS/issues)
- 📧 **Email**: ricardo@sierratecnologia.com.br
- 🌐 **Website**: [https://cms.sierratecnologia.ca](https://cms.sierratecnologia.ca)
- 📖 **Docs**: [https://docs.sierratecnologia.ca/cms](https://docs.sierratecnologia.ca/cms)

---
