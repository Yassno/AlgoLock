<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Free and open-source online code editor that allows you to write and execute code from a rich set of languages.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="AlgoLock IDE - editeur de code en ligne">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/goldenlayout.min.js" integrity="sha256-NhJAZDfGgv4PiB+GVlSrPdh3uc75XXYSM4su8hgTchI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/css/goldenlayout-base.css" integrity="sha256-oIDR18yKFZtfjCJfDsJYpTBv1S9QmxYopeqw2dO96xM=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/golden-layout/1.5.9/css/goldenlayout-dark-theme.css" integrity="sha256-ygw8PvSDJJUGLf6Q9KIQsYR3mOmiQNlDaxMLDOx9xL0=" crossorigin="anonymous" />

    <script>
        var require = {
            paths: {
                "vs": "{{ url('assets/ide/vendor/monaco-editor-0.44.0/min/vs')}}"
            }
        };
    </script>
    <script src="{{ url('/assets/ide/vendor/monaco-editor-0.44.0/min/vs/loader.js')}}"></script>
    <script src="{{ url('/assets/ide/vendor/monaco-editor-0.44.0/min/vs/editor/editor.main.nls.js')}}"></script>
    <script src="{{ url('/assets/ide/vendor/monaco-editor-0.44.0/min/vs/editor/editor.main.js')}}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css" integrity="sha256-9mbkOfVho3ZPXfM7W8sV2SndrGDuh7wuyLjtsWeTI1Q=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js" integrity="sha256-t8GepnyPmw9t+foMh3mKNvcorqNHamSKtKRxxpUEgFI=" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

    <script type="text/javascript" src="{{ url('/assets/ide/third_party/download.js')}}"></script>

    <script type="text/javascript" src="{{ url('/assets/ide/js/ide.js')}}"></script>

    <link type="text/css" rel="stylesheet" href="{{ url('/assets/ide/css/ide.css')}}">

    <title>AlgoLock IDE</title>
  <link href="{{url('/assets/back/img/favicon.png')}}" rel="icon">
  <link href="{{url('/assets/back/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <script defer data-domain="ide.AlgoLock.com" src="https://plausible.judge0.com/js/script.js"></script>
</head>

<body>
<div id="site-navigation" class="ui small inverted menu">
        <div id="site-header" class="header item">
            <a href="/">
                <img id="site-icon" src="{{url('/assets/ide/images/algolock_icon.png')}}">
                <h2>AlgoLock IDE</h2>
            </a>
        </div>
        <div class="left menu">
            <div class="ui dropdown item site-links on-hover">
                Fichier <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" target="_blank" href="/"><i class="file code icon"></i> Nouveau fichier</a>
                    <div class="item" onclick="downloadSource()"><i class="download icon"></i> Telecharger</div>
                    <div id="insert-template-btn" class="item"><i class="file code outline icon"></i>Inserer votre fichier</div>
                </div>
            </div>
            <div class="item borderless">
            <select id="select-language" class="ui dropdown">
                    <option value="1001" mode="c">C (Clang 10.0.1)</option>
                    <option value="1022" mode="csharp">C# (Mono 6.10.0.104)</option>
                    <option value="1021" mode="csharp">C# (.NET Core SDK 3.1.302)</option>
                    <option value="1002" mode="cpp">C++ (Clang 10.0.1)</option>
                    <option value="1004" mode="java">Java (OpenJDK 14.0.1)</option>
                    <option value="1010" mode="python">Python for ML (3.7.3)</option>
                </select>
            </div>
            <div class="item fitted borderless wide screen only">
            </div>
            <div class="item borderless wide screen only">
                <div class="ui input">
                    <input id="command-line-arguments" type="text" placeholder="Command line arguments"></input>
                </div>
            </div>
            <div class="item no-left-padding borderless">
                <button id="run-btn" class="ui primary labeled icon button"><i class="play icon"></i><span id="run-btn-label">Run (⌘ + ↵)</span></button>
            </div>
            <div id="navigation-message" class="item borderless">
                <span class="navigation-message-text"></span>
            </div>
        </div>
    </div>

    <div id="site-content"></div>

    <div id="site-modal" class="ui modal">
        <div class="header">
            <i class="close icon"></i>
            <span id="title"></span>
        </div>
        <div class="scrolling content"></div>
        <div class="actions">
            <div class="ui small labeled icon cancel button">
                <i class="remove icon"></i>
                Close (ESC)
            </div>
        </div>
    </div>

    <div id="site-footer">
        <span><a href="PRIVACY.md">Privacy Policy</a></span>
        <span>•</span>
        <span><a href="TERMS.md">Terms of Service</a></span>
        <span>•</span>
        <span>© 2024 AlgoLock – All Rights Reserved.</a>
        <span id="status-line"></span>
    </div>
</body>

</html>
