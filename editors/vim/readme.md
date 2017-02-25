#Keymap

##General
* ,d: Duplicate line
* ,"space": :nohlsearch

##File edits
* ,ev: Edit .vimrc
* ,es: Edit snippets
* ,ep: Edit plugins

##Splits
* Ctrl + W + W: Toggle split
* Ctrl + H: Left side  split
* Ctrl + L: Right side split

##Syntax
* ,ss: Set HTML syntax

##ctags
* ,f: Find tag (ctags)
* ,uc: Generate ctags (exclude node_modules, vedor, tests)

##CtrlP (quick file open)
* Cmd + P: CtrlP
* Cmd + R: Navigate through CtrlP tags
* Cmd + E: CtrlP MRU

##NERDTree
* Cmd + 1: Toggle sidebar

##git
* ,ga: Gwrite
* ,gc: Commit
* ,gs: Status
* ,gp: Push

##Laravel specific
* ,lw: Open routes/web.php
* ,la: Open routes/api.php
* ,lm: php artisam make
* ,,c: List all Controllers
* ,,m: List all Models
* ,,v: List all Views

##PHP
* ,pd: PHPDoc
* ,n: Insert user statement
* ,nf: Expand fully qualifed class name
* ,su: Sort use statements by length
* @ + a: Assign constructor variable, and initialize it (you have an argument, and you want to make it a class variable, and give it a value in constructor)

##Plugin related
* :tag "tag": Go to ctag
* ysiw"char": Add surraund
* Crtl + y + ,: Emmet
* gcc: Comment out selection
* Find in whole project: :Ag "term" / :Gsearch "term"
