YUI.add('thecocktail-awspollyfile-view', function (Y) {
    "use strict";
    /**
     * Provides the Binary File field view
     *
     * @module thecocktail-awspollyfile-view
     */
    Y.namespace('theCocktail');

    /**
     * The Binary File field view
     *
     * @namespace eZ
     * @class BinaryFileView
     * @constructor
     * @extends eZ.FieldView
     */
    Y.theCocktail.AwsPollyFileView = Y.Base.create('awsPollyFileView', Y.eZ.FieldView, [], {});

    Y.eZ.FieldView.registerFieldView('ezawspollyfile', Y.theCocktail.AwsPollyFileView);
});
