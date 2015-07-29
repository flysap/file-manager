<textarea id="editor">{{$contents}}</textarea>

<style type="text/css">
    .CodeMirror {
        border: 1px solid #eee;
        height: auto;
        width: 1400px;
    }
</style>
<link rel="stylesheet" href="/assets/codemirror/lib/codemirror.css">
<link rel="stylesheet" href="/assets/codemirror//theme/dracula.css">
<script src="/assets/codemirror/lib/codemirror.js"></script>
<script src="/assets/codemirror/addon/selection/active-line.js"></script>
<script src="/assets/codemirror/addon/edit/matchbrackets.js"></script>
<script type="text/javascript">
    var editor = CodeMirror.fromTextArea(document.getElementById("editor"), {
        lineNumbers: true,
        styleActiveLine: true,
        matchBrackets: true,
        theme: "dracula"
    });
</script>