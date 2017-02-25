set nocompatible              " be iMproved, required

set swapfile
set dir=~/tmp

so ~/.vim/plugins.vim
source ~/.vim/bundle/php-doc/php-doc.vim 

syntax enable

set backspace=indent,eol,start			"Backspace default mukodes
let mapleader = ','				", az alapertelmezett / helyett
set number					"Sorok kijelzese
set linespace=17				"Macvim sortavolsag
set autowriteall 				"automatikus mentes
set complete=.,w,b,u,i,kspell 				"autocomplete 
set tabstop=8
set expandtab
set softtabstop=4
set shiftwidth=4
set relativenumber
set wildmenu
set tags=tags;/
set nowrap
set runtimepath^=~/.vim/bundle/php-doc/php-doc.vim

"Konsruktor parameterbol ertekadast es adattagot (protected) csinal
let @a="yiw€ýb€ýa€ýK€ýK€ýL€ýK€ýL€ýb€ýa/}O€ýb€ýa$this->p€ýb€ýaa = €ýb€ýa$pa;€ýb€ýa€ýb€ýa?construct€ýb€ýaOprotected €ýb€ýa$p€ýb€ýaa;€ý,€ý.€ýb€ýa/construct€ýb€ýa/\"€ýb€ýa€ýb€ýa, "
let @b="wwciw[wwi]b€ýb€ýaysiw'"
let @m="xwxbysiw*"
"---------------Visuals-------------"
colorscheme atom-dark
set macligatures				"Fira_Code font hasznalata
set t_CO=256					"Terminal szinek
set guifont=Fira_Code:h17			"Fira Code betutipus 17 meret
set guioptions-=l				"Nincs bal oldali scroll
set guioptions-=L				"Nincs bal oldali scroll splitnel
set guioptions-=r				"Nincs jobb oldali scroll
set guioptions-=R				"Nincs jobb oldali scroll splitnel
set guioptions-=e				"Feher tab sav helyett, csak a fileok nevet irja ki

hi LineNr guibg=bg				"Sorszamok hatterszine
set foldcolumn=2				"Bal oldali padding fake
hi foldcolumn guibg = bg			"Bal oldali padding hatterszin

hi vertsplit guifg=bg guibg=bg			"Lathatatlan valaszto vonal




"---------------Search-------------"
set hlsearch					"Keresesi talalatok kijelolese
set incsearch					"incremental kereses, real-time
set ignorecase                                  "case-insensitive kereses

"---------------Split-------------"
nmap <C-J> <C-W><C-J>
nmap <C-K> <C-W><C-K>
nmap <C-H> <C-W><C-H>
nmap <C-L> <C-W><C-L>


"---------------Mappings-------------"

".vimrc szerkesztese
nmap <Leader>ev :tabedit ~/.vimrc<cr>
nmap <Leader>es :tabedit ~/.vim/snippets/
nmap <Leader>ep :tabedit ~/.vim/plugins.vim<cr>

"html sytanx
nmap <Leader>ss :set syntax=html<cr>

"Kijeloles megszuntetese
nmap <Leader><space> :nohlsearch<cr>

"Sor duplikalas
nmap <Leader>d Yp

nmap <Leader>f :tag<space>

nmap <Leader>uc :!ctags -R --exclude=node_modules --exclude=vendor --exclude=tests<cr>

inoremap <Leader>pd :call PhpDocSingle()<CR>i 
nnoremap <Leader>pd :call PhpDocSingle()<CR> 
vnoremap <Leader>pd :call PhpDocRange()<CR>

"---------------Plugins--------"
"CtrlP

"Mappak kizarasa
let g:ctrlp_custom_ignore = 'node_modules\DS_Store\|git'
let g:ctrlp_show_hidden = 1

nmap <D-p> :CtrlP<cr>

"ctrlp tag navigalas (metodusok, adattagok)
nmap <D-r> :CtrlPBufTag<cr>

"ctrlp nemreg megnyitott fileok
nmap <D-e> :CtrlPMRU<cr>


"NERDTree
let NERDTreeHijackNetrw = 0

let NERDTreeShowHidden=1

"NERDTree Toggle
nmap <D-1> :NERDTreeToggle<cr>

"greplace.vim
set grepprg=ag								"Ag a kereseshez
let g:grep_cmd_opts = '--line-numbers --noheading'

"airline
set laststatus=2
set ttimeoutlen=50

"Fugitive
nmap <Leader>ga :Gwrite<cr>
nmap <Leader>gc :Gcommit<cr>
nmap <Leader>gs :Gstatus<cr>
nmap <Leader>gp :Git push<cr>

"Syntastic
" set statusline+=%#warningmsg#
" set statusline+=%{SyntasticStatuslineFlag()}
" set statusline+=%*

let g:syntastic_always_populate_loc_list = 1
let g:syntastic_auto_loc_list = 1
let g:syntastic_check_on_open = 1
let g:syntastic_check_on_wq = 0

"---------------Laravel Specific--------"
nmap <Leader>lw :e routes/web.php<cr> 
nmap <Leader>la :e routes/api.php<cr>
nmap <Leader>lm :!php artisan make:
nmap <Leader><Leader>c :CtrlP<cr>app/Http/Controllers/
nmap <Leader><Leader>m :CtrlP<cr>app/
nmap <Leader><Leader>v :CtrlP<cr>resources/views



"---------------Auto-Commands--------"
"Auto source vimr on save
augroup autosourcing
	autocmd!
        autocmd VimEnter,BufNewFile,BufReadPost * silent! call HardMode()
	autocmd BufWritePost .vimrc source %
augroup END

"arnaud-lb/vim-php-namespace kiegeszites
function! IPhpInsertUse()
    call PhpInsertUse()
    call feedkeys('a',  'n')
endfunction
autocmd FileType php inoremap <Leader>n <Esc>:call IPhpInsertUse()<CR>
autocmd FileType php noremap <Leader>n :call PhpInsertUse()<CR>

function! IPhpExpandClass()
    call PhpExpandClass()
    call feedkeys('a', 'n')
endfunction
autocmd FileType php inoremap <Leader>nf <Esc>:call IPhpExpandClass()<CR>
autocmd FileType php noremap <Leader>nf :call PhpExpandClass()<CR>

nmap <Leader>su ! awk '{print length(), $0 \| "sort -n \| cut -d\\  -f2-"}'<cr>
