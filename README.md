# eZ Aws Polly Bundle

This bundle allows the integration of Aws Polly with eZ Platform

## Installation

Installation can be done via composer

```bash
composer require the-cocktail/ez-aws-polly-bundle
```

## Configuration

Once you have all the packages you need to modify your AppKernel in other
to enable some bundles. 

```php
        $bundles = array(
            /*...*/
            new \Kaliop\eZMigrationBundle\EzMigrationBundle(),
            new \Kaliop\eZWorkflowEngineBundle\EzWorkflowEngineBundle(),
            new \TheCocktail\EzAwsPollyBundle\TheCocktailEzAwsPollyBundle(),
            /*...*/
        );

```

The Bundle uses [league/flystem](https://flysystem.thephpleague.com/). You need 
to configure at least one filesystem to store the sound files that amazon will return 
us. Here is an example. Put it in your `config.yml` and modify as you want. 
```yaml
oneup_flysystem:
    adapters:
        polly_adapter:
            local:
                directory: "tmp/polly"
    filesystems:
        polly_files:
            adapter: polly_adapter
            disable_asserts: true
```

With the config above, files created by polly will be stored in `tmp/polly`. 

Please note that you can store in any other place, like Google Cloud or Amazon S3 Storage. 

Also, you will need to add your aws credentials as params. add something like this to your params.yml
```yaml
    aws_region: ****
    aws_key: ****
    aws_secret: ****

```

Finally, you need to add a field to the content type(s) you want to work with. The default bundle assumes
you will do that with folders. You'll be adding an `ezawspollyfile` to your `folder` content type and that you
will set `polly` as the identifier for this field. 

## How it works

The bundle adds a new fieldtype `ezawspollyfile` to your eZPlatform installation. This fieldtype is, for now,
very similar to the `ezbinaryfile` one. 

When a content is published in the admin interface (or via custom command or whatever that may be
using the eZ Publish API), a process will call Amazon Polly and will return an mp3 file. 
Same process will use that file to store in one of the attributes of the content. 

It can do this thanks to the wonderful [eZ Workflow Engine Bundle](https://github.com/kaliop-uk/ezworkflowenginebundle) created
by our friend [Gaetano Giunta](https://github.com/gggeek). Read the doc there
and the related documentation for the not less wonderful [Kaliop Migration Bundle](https://github.com/kaliop-uk/ezmigrationbundle). 

With this bundle we only provide a [workflow definition](./src/WorkflowDefinitions/GenerateAwsPollyFileForFolder.yml) that will try to create 
the sound file only if the published content is a folder. 

To create the sound file it needs to pass to Polly a text. This text is built doing a 
another request passing `ssml` as *viewType*. This allows to define *ssml* templates
per content type or per any other match condition. Exactly the same as you will do with *full*
viewType. 

## Todo
Tests, tests and more tests...

## Limitations

* This bundle is in a very basic state. As said before, for now it works for folders, 
but you can take that workflow definition as the starting point to add your owns. 

* SSML is hardcoded format for now, but will be made configurable in the future. 

* Transformation of RichText files are very very basic for now. It just transform to html and
strip all tags except `<p>`.

* For adding the sound file to the content, the field identifier of the `ezawspollyfile` must be
called `polly`.  

## Ideas for the future

* Make voice depend on the language of the version we're publishing. Polly has different `voices` that 
you can use and that fits better with the language of the content to be speeched. 

* Create a `rich_to_ssml` converter, maybe based in xslt too, similar to `richtext_to_html5`

* Custom tags or attributes could be added to rich text to control volume, pauses and many more. 

## Links of interest

* [Getting Started with Amazon Polly](https://aws.amazon.com/polly/getting-started/?nc1=h_ls)
* [SSML Specification](https://www.w3.org/TR/speech-synthesis11/)

## Demo

See this video to get an idea on how it works. 

[![eZ Aws Polly in action](https://img.youtube.com/vi/IzNAkje4Z4w/0.jpg)](https://www.youtube.com/watch?v=IzNAkje4Z4w)

And here's the mp3 created by Aws Polly. 

<audio controls preload> 
    <source src="welcome-to-ez.mp3
"></source> 
    <a href="welcome-to-ez.mp3">welcome to ez</a> 
</audio>

P.S: Thanks so much to @gggeek, @ilukac and all the ez publish community for giving some hints even on Saturday. ;)


