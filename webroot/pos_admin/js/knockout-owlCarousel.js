(function(factory) {
    if (typeof define === "function" && define.amd) {
        // AMD anonymous module
        define(["knockout", "jquery"], factory);
    } else {
        // No module loader (plain <script> tag) - put directly in global namespace
        factory(window.ko, window.jQuery);
    }
})
(function(ko,$){
    var templateKey = ko.utils.domData.nextKey;
    ko.bindingHandlers.owlCarousel = {

        init: function(element, valueAccessor,allBindings, viewModel, bindingContext) {
            // The options that have been configured with the owlCarousel binding
            var options = ko.utils.unwrapObservable(valueAccessor().options) || {};
            var template = moveCleanedNodesToContainerElement(ko.virtualElements.childNodes(element));
            var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
            if (MutationObserver){
                new MutationObserver(function(){
                    ko.bindingHandlers.owlCarousel.update(element,valueAccessor,allBindings,viewModel,bindingContext)
                }).observe(template, {childList: true});
            }
            ko.bindingHandlers.foreach.init(template,valueAccessor,allBindings,viewModel,bindingContext);
            ko.utils.domData.set(element,templateKey,template);
            // Initialize carousel with options
            $(element).owlCarousel(options);

            // Register a callback that is being executed when the element is removed
            // in that case the carousel is no longer required and can be destroyed
            ko.utils.domNodeDisposal.addDisposeCallback(element, function() {
                element.trigger('destroy.owl.carousel');
            });
            return { 'controlsDescendantBindings': true };
        },
        update: function(element, valueAccessor,allBindings, viewModel, bindingContext){
            var template = ko.utils.domData.get(element,templateKey);
            ko.bindingHandlers.foreach.update(template,valueAccessor,allBindings,viewModel,bindingContext)
            $(element).trigger('replace.owl.carousel',[$($(template).html())]).trigger('refresh.owl.carousel');
        }
    };
    ko.expressionRewriting.bindingRewriteValidators['owlCarousel'] = false; // Can't rewrite control flow bindings
});

function moveCleanedNodesToContainerElement(nodes) {
    var nodesArray = makeArray(nodes);
    var container = document.createElement('div');
    for(var i = 0, j = nodesArray.length; i < j; i++) {
        //container.appendChild(ko.cleanNode(nodesArray[i]));
		container.appendChild(nodesArray[i]);
    }
    return container;
}
function makeArray(arrayLikeObject) {
    var result = [];
    for(var i = 0, j = arrayLikeObject.length; i < j; i++) {
        result.push(arrayLikeObject[i]);
    }
    ;
    return result;
}