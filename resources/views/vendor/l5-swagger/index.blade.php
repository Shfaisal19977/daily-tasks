<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $documentationTitle }}</title>
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16"/>
    <style>
    html
    {
        box-sizing: border-box;
        overflow: -moz-scrollbars-vertical;
        overflow-y: scroll;
    }
    *,
    *:before,
    *:after
    {
        box-sizing: inherit;
    }

    body {
      margin:0;
      background: #fafafa;
    }
    </style>
    @if(config('l5-swagger.defaults.ui.display.dark_mode'))
        <style>
            /* Enhanced Dark Mode with Better Colors */
            body#dark-mode,
            #dark-mode .scheme-container {
                background: #0f172a;
            }
            
            #dark-mode .swagger-ui {
                background: #0f172a;
            }
            
            #dark-mode .topbar {
                background: #1e293b;
                border-bottom: 1px solid #334155;
            }
            
            #dark-mode .scheme-container,
            #dark-mode .opblock .opblock-section-header{
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.4);
                background: #1e293b;
            }
            
            #dark-mode .operation-filter-input,
            #dark-mode .dialog-ux .modal-ux,
            #dark-mode input[type=email],
            #dark-mode input[type=file],
            #dark-mode input[type=password],
            #dark-mode input[type=search],
            #dark-mode input[type=text],
            #dark-mode textarea,
            #dark-mode select {
                background: #1e293b;
                color: #e2e8f0;
                border: 1px solid #334155;
            }
            
            #dark-mode .operation-filter-input:focus,
            #dark-mode input[type=text]:focus,
            #dark-mode textarea:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                outline: none;
            }
            
            #dark-mode .title,
            #dark-mode li,
            #dark-mode p,
            #dark-mode table,
            #dark-mode label,
            #dark-mode .opblock-tag,
            #dark-mode .opblock .opblock-summary-operation-id,
            #dark-mode .opblock .opblock-summary-path,
            #dark-mode .opblock .opblock-summary-path__deprecated,
            #dark-mode h1,
            #dark-mode h2,
            #dark-mode h3,
            #dark-mode h4,
            #dark-mode h5,
            #dark-mode .btn,
            #dark-mode .tab li,
            #dark-mode .parameter__name,
            #dark-mode .parameter__type,
            #dark-mode .prop-format,
            #dark-mode .loading-container .loading:after{
                color: #e2e8f0;
            }
            
            #dark-mode .opblock-description-wrapper p,
            #dark-mode .opblock-external-docs-wrapper p,
            #dark-mode .opblock-title_normal p,
            #dark-mode .response-col_status,
            #dark-mode table thead tr td,
            #dark-mode table thead tr th,
            #dark-mode .response-col_links{
                color: #cbd5e1;
            }
            
            #dark-mode .parameter__extension,
            #dark-mode .parameter__in,
            #dark-mode .model-title{
                color: #94a3b8;
            }
            
            #dark-mode table thead tr td,
            #dark-mode table thead tr th{
                border-color: #334155;
                background: #1e293b;
            }
            
            #dark-mode .opblock .opblock-section-header{
                background: #1e293b;
                border-bottom: 1px solid #334155;
            }
            
            /* Enhanced HTTP Method Colors - More Vibrant */
            #dark-mode .opblock.opblock-post{
                background: rgba(34, 197, 94, 0.12);
                border-left: 4px solid #22c55e;
            }
            
            #dark-mode .opblock.opblock-get{
                background: rgba(59, 130, 246, 0.12);
                border-left: 4px solid #3b82f6;
            }
            
            #dark-mode .opblock.opblock-put{
                background: rgba(251, 191, 36, 0.12);
                border-left: 4px solid #fbbf24;
            }
            
            #dark-mode .opblock.opblock-patch{
                background: rgba(251, 191, 36, 0.12);
                border-left: 4px solid #fbbf24;
            }
            
            #dark-mode .opblock.opblock-delete{
                background: rgba(239, 68, 68, 0.12);
                border-left: 4px solid #ef4444;
            }
            
            #dark-mode .opblock-summary {
                border-color: #334155;
            }
            
            #dark-mode .opblock-summary:hover {
                background: rgba(255, 255, 255, 0.05);
            }
            
            #dark-mode .opblock-summary-method {
                font-weight: 600;
                text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            }
            
            #dark-mode .opblock-summary-method.opblock-post {
                background: #22c55e;
                color: #fff;
            }
            
            #dark-mode .opblock-summary-method.opblock-get {
                background: #3b82f6;
                color: #fff;
            }
            
            #dark-mode .opblock-summary-method.opblock-put {
                background: #fbbf24;
                color: #1e293b;
            }
            
            #dark-mode .opblock-summary-method.opblock-patch {
                background: #fbbf24;
                color: #1e293b;
            }
            
            #dark-mode .opblock-summary-method.opblock-delete {
                background: #ef4444;
                color: #fff;
            }
            
            #dark-mode .btn.execute {
                background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
                color: #fff;
                border: none;
                box-shadow: 0 2px 4px rgba(59, 130, 246, 0.3);
            }
            
            #dark-mode .btn.execute:hover {
                background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
                box-shadow: 0 4px 8px rgba(59, 130, 246, 0.4);
            }
            
            #dark-mode .btn.cancel {
                background: #475569;
                color: #fff;
                border: none;
            }
            
            #dark-mode .btn.cancel:hover {
                background: #64748b;
            }
            
            #dark-mode .response-col_status {
                font-weight: 600;
            }
            
            #dark-mode .response-col_status[data-code="200"],
            #dark-mode .response-col_status[data-code="201"] {
                color: #22c55e;
            }
            
            #dark-mode .response-col_status[data-code="404"],
            #dark-mode .response-col_status[data-code="422"],
            #dark-mode .response-col_status[data-code="500"] {
                color: #ef4444;
            }
            
            #dark-mode .loading-container .loading:before{
                border-color: rgba(59, 130, 246, 0.3);
                border-top-color: #3b82f6;
            }
            
            #dark-mode svg:not(:root){
                fill: #cbd5e1;
            }
            
            #dark-mode .opblock-summary-description {
                color: #94a3b8;
            }
            
            #dark-mode .info {
                background: #1e293b;
                border: 1px solid #334155;
            }
            
            #dark-mode .info .title {
                color: #3b82f6;
            }
            
            #dark-mode .model-box {
                background: #1e293b;
                border: 1px solid #334155;
            }
            
            #dark-mode .model-title {
                color: #3b82f6;
            }
            
            #dark-mode code {
                background: #0f172a;
                color: #fbbf24;
                padding: 2px 6px;
                border-radius: 4px;
                font-weight: 500;
            }
            
            #dark-mode pre {
                background: #0f172a;
                border: 1px solid #334155;
            }
            
            #dark-mode .highlight-code {
                background: #1e293b;
            }
            
            #dark-mode .response-content-type {
                color: #94a3b8;
            }
            
            #dark-mode .tab li {
                border-bottom: 2px solid transparent;
            }
            
            #dark-mode .tab li.active {
                border-bottom-color: #3b82f6;
                color: #3b82f6;
            }
            
            #dark-mode .tab li button {
                color: #cbd5e1;
            }
            
            #dark-mode .tab li.active button {
                color: #3b82f6;
            }
            
            #dark-mode .opblock-tag {
                color: #e2e8f0;
                border-bottom: 1px solid #334155;
            }
            
            #dark-mode .opblock-tag:hover {
                background: rgba(255, 255, 255, 0.03);
            }
        </style>
    @endif
</head>

<body @if(config('l5-swagger.defaults.ui.display.dark_mode')) id="dark-mode" @endif>
<div id="swagger-ui"></div>

<script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
<script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
<script>
    window.onload = function() {
        const urls = [];

        @foreach($urlsToDocs as $title => $url)
            urls.push({name: "{{ $title }}", url: "{{ $url }}"});
        @endforeach

        // Build a system
        const ui = SwaggerUIBundle({
            dom_id: '#swagger-ui',
            urls: urls,
            "urls.primaryName": "{{ $documentationTitle }}",
            operationsSorter: {!! isset($operationsSorter) ? '"' . $operationsSorter . '"' : 'null' !!},
            configUrl: {!! isset($configUrl) ? '"' . $configUrl . '"' : 'null' !!},
            validatorUrl: {!! isset($validatorUrl) ? '"' . $validatorUrl . '"' : 'null' !!},
            oauth2RedirectUrl: "{{ route('l5-swagger.'.$documentation.'.oauth2_callback', [], $useAbsolutePath) }}",

            requestInterceptor: function(request) {
                request.headers['X-CSRF-TOKEN'] = '{{ csrf_token() }}';
                return request;
            },

            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],

            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],

            layout: "StandaloneLayout",
            docExpansion : "{!! config('l5-swagger.defaults.ui.display.doc_expansion', 'none') !!}",
            deepLinking: true,
            filter: {!! config('l5-swagger.defaults.ui.display.filter') ? 'true' : 'false' !!},
            persistAuthorization: "{!! config('l5-swagger.defaults.ui.authorization.persist_authorization') ? 'true' : 'false' !!}",

        })

        window.ui = ui

        @if(in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type')))
        ui.initOAuth({
            usePkceWithAuthorizationCodeGrant: "{!! (bool)config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant') !!}"
        })
        @endif
    }
</script>
</body>
</html>
