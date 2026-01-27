<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Commands\ImportDlcBlogs;

class ImportDlcBlogsBatch extends Command
{
    protected $signature = 'blogs:import-dlc-batch';
    protected $description = 'Import all blog posts from dlc.co.ke/blog-2/ using extracted URLs';

    protected $blogUrls = [
        'https://dlc.co.ke/professional-coach-training-courses-in-kenya-become-a-certified-icr-coach/',
        'https://dlc.co.ke/the-school-of-life/',
        'https://dlc.co.ke/the-breakthrough-forum/',
        'https://dlc.co.ke/how-to-become-a-professional-life-coach-in-kenya-insights-into-destiny-life-coaching/',
        'https://dlc.co.ke/how-to-become-a-certified-life-coach-with-destiny-life-coaching-in-kenya-your-ultimate-guide/',
        'https://dlc.co.ke/how-to-change-your-life-completely/',
        'https://dlc.co.ke/personal-development-training-in-kenya/',
        'https://dlc.co.ke/life-coaching-course-in-kenya/',
        'https://dlc.co.ke/you-need-to-know-about-building-a-life-coaching-brand/',
        'https://dlc.co.ke/become-a-professional-life-coach/',
        'https://dlc.co.ke/how-to-get-a-life-coach-certification/',
        'https://dlc.co.ke/why-is-life-coaching-important/',
        'https://dlc.co.ke/what-is-a-simple-self-coaching-method/',
        'https://dlc.co.ke/seven-principles-of-life-coaching/',
        'https://dlc.co.ke/online-life-coaching-can-provide-the-help-you-need/',
        'https://dlc.co.ke/life-coaching-tips-organize-yourself-for-success/',
        'https://dlc.co.ke/what-are-your-income-salary-and-annual-income-as-a-professional-life-coach/',
        'https://dlc.co.ke/is-a-personal-life-coach-suitable-for-you/',
        'https://dlc.co.ke/how-to-become-a-life-coach-qualifications-and-necessary-expenses/',
    ];

    public function handle()
    {
        $this->info('Starting batch import of ' . count($this->blogUrls) . ' blog posts...');
        $this->newLine();

        $importCommand = new ImportDlcBlogs();
        $imported = 0;
        $skipped = 0;
        $errors = 0;

        $bar = $this->output->createProgressBar(count($this->blogUrls));
        $bar->start();

        foreach ($this->blogUrls as $url) {
            try {
                $importCommand->importBlogPost($url);
                $imported++;
            } catch (\Exception $e) {
                $errors++;
                $this->newLine();
                $this->warn("Error importing {$url}: " . $e->getMessage());
            }
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        $this->info("Batch import completed!");
        $this->info("  - Imported: {$imported}");
        $this->info("  - Errors: {$errors}");

        return Command::SUCCESS;
    }
}
