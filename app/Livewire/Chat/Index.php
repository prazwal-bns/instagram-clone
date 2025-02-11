<?php

namespace App\Livewire\Chat;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div class="w-full h-[calc(100vh_-_0.0rem)] flex bg-white    rounded-lg" >
                    <div class="  relative dark:border-gray-600 w-full h-full md:w-[320px] xl:w-[400px] border-r shrink-0 overflow-y-auto  ">
                        <livewire:chat.chat-list>
                    </div>
                    <main class="relative hidden w-full h-full overflow-y-auto md:grid dark:border-gray-700"  style="contain:content">

                    <div class="flex flex-col items-center justify-center col-span-12 gap-3 m-auto text-center">
                           <span class="m-auto ">
                            <svg class="text-gray-800 w-14 h-14" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"
                                   id="messenger">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14.268,2.112A13,13,0,0,0,6,23.3v3.661A1.258,1.258,0,0,0,7.82,28.09l2.663-1.332a12.9,12.9,0,0,0,7.25,1.126A13,13,0,1,0,14.268,2.112Z">
                                </path>
                                <path
                                    d="M9.049,18.163,13.64,11.63a.64.64,0,0,1,.94-.2l3.075,2.307a.641.641,0,0,0,.714.036l3.745-2.646a.64.64,0,0,1,.9.835l-3.707,6.414a.64.64,0,0,1-.9.263L14.3,16.181a.638.638,0,0,0-.615-.024l-3.794,2.9A.641.641,0,0,1,9.049,18.163Z">
                                </path>
                            </svg>
                            </span>

                             <h4 class="text-lg font-medium">Send private photos and messages</h4>

                        </div>
                    </main>
                </div>
        HTML;
    }
}
