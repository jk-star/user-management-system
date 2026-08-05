<?php

namespace App\Controllers;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

class TutorialController extends BaseController
{
    public function chapter($chapter = 'step1_layout')
    {
        $folder = APPPATH . 'Views/project_document/';

        // Current markdown file
        $file = $folder . $chapter . '.md';

        if (!file_exists($file)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Current chapter read
        $markdown = file_get_contents($file);

        // Markdown converter
        $environment = new Environment();

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());

        $converter = new MarkdownConverter($environment);

        $html = $converter->convert($markdown)->getContent();


        // All markdown files
        $files = glob($folder . '*.md');

        $chapters = [];

        foreach ($files as $chapterFile) {

            $filename = pathinfo($chapterFile, PATHINFO_FILENAME);

            $chapters[] = [
                'filename' => $filename,
                'title'    => ucwords(
                    str_replace(['_', '-'], ' ', $filename)
                )
            ];
        }


        return view('tutorial', [
            'content'        => $html,
            'chapters'       => $chapters,
            'currentChapter' => $chapter
        ]);
    }
}
