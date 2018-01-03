function foo() {

    var a = 1;
    return (function() {
        return a;
    })();

};