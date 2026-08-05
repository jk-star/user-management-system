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

        $file = $folder . $chapter . '.md';

        // 1. Check current file
        if (!file_exists($file)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 2. Read markdown
        $markdown = file_get_contents($file);

        // 3. Convert markdown → HTML
        $environment = new Environment();

        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new TableExtension());

        $converter = new MarkdownConverter($environment);

        $html = $converter->convert($markdown)->getContent();


        // 4. Get all chapters
        $files = glob($folder . '*.md');

        // Natural sorting
        natsort($files);
        $files = array_values($files);

        $chapters = [];

        foreach ($files as $chapterFile) {

            $filename = pathinfo(
                $chapterFile,
                PATHINFO_FILENAME
            );

            // Filename se step number aur title nikalo
            if (preg_match('/^step(\d+)[_-](.+)$/i', $filename, $matches)) {

                $stepNumber = $matches[1];

                $title = str_replace(
                    ['_', '-'],
                    ' ',
                    $matches[2]
                );

                $title = ucwords($title);

                $displayTitle = 'Step ' . $stepNumber . ' - ' . $title;
            } else {

                // Fallback
                $displayTitle = ucwords(
                    str_replace(['_', '-'], ' ', $filename)
                );
            }

            $chapters[] = [
                'filename' => $filename,
                'title'    => $displayTitle
            ];
        }


        // 5. Find current chapter index
        $currentIndex = null;

        foreach ($chapters as $index => $item) {

            if ($item['filename'] === $chapter) {

                $currentIndex = $index;

                break;
            }
        }


        // 6. Previous / Next
        $previousChapter = null;
        $nextChapter = null;

        if ($currentIndex !== null) {

            // Previous
            if ($currentIndex > 0) {
                $previousChapter = $chapters[$currentIndex - 1];
            }

            // Next
            if ($currentIndex < count($chapters) - 1) {
                $nextChapter = $chapters[$currentIndex + 1];
            }
        }


        // 7. Send data to view
        return view('tutorial', [

            'content' => $html,

            'chapters' => $chapters,

            'currentChapter' => $chapter,

            'previousChapter' => $previousChapter,

            'nextChapter' => $nextChapter
        ]);
    }
}
