<textarea id="editor">{{$contents}}</textarea>

<link rel="stylesheet" href="/assets/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="/assets/codemirror//theme/{{$attributes['active_theme']}}.css">
<script src="/assets/codemirror/lib/codemirror.js"></script>
<script src="/assets/codemirror/addon/selection/active-line.js"></script>
<script src="/assets/codemirror/addon/edit/matchbrackets.js"></script>

<style type="text/css">
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
    }
</style>

<script type="text/javascript">
    @if(isset($attributes['on_click']))
        $("{{ $attributes['on_click'] }}").on("click", function() {
    @endif

        setTimeout(function() {
           if(! window.codeEditor) {
               window.codeEditor = CodeMirror.fromTextArea(document.getElementById("editor"), {
                   lineNumbers: true,
                   styleActiveLine: true,
                   matchBrackets: true,
                   theme: "{{$attributes['active_theme']}}"
               });
           }
        }, 0);

    @if(isset($attributes['on_click'])) }); @endif
</script>