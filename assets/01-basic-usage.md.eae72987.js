import{_ as s,c as a,o as n,a as l}from"./app.34b57b74.js";const A=JSON.parse('{"title":"Basic usage","description":"","frontmatter":{},"headers":[{"level":2,"title":"Using the Pattern helper functions","slug":"using-the-pattern-helper-functions"},{"level":2,"title":"The fallback template","slug":"the-fallback-template"},{"level":3,"title":"Changing the fallback template path","slug":"changing-the-fallback-template-path"}],"relativePath":"01-basic-usage.md"}'),p={name:"01-basic-usage.md"},e=l(`<h1 id="basic-usage" tabindex="-1">Basic usage <a class="header-anchor" href="#basic-usage" aria-hidden="true">#</a></h1><p>The easiest way to get up and running with Conventions is to use the shorthand syntax:</p><div class="language-php"><span class="copy"></span><pre><code><span class="line"><span style="color:#676E95;font-style:italic;">// config/conventions.php</span></span>
<span class="line"><span style="color:#89DDFF;font-style:italic;">return</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">patterns</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">partial</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_partials</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">field</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_fields</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">component</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_components</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">defaults</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">          </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">params</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">ensure</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[],</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">require</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[],</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">reject</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[],</span></span>
<span class="line"><span style="color:#A6ACCD;">          </span><span style="color:#89DDFF;">]</span></span>
<span class="line"><span style="color:#A6ACCD;">   </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#89DDFF;">];</span></span>
<span class="line"></span></code></pre></div><p>This will create three <a href="./05-concepts.html#pattern-types"><code>PatternType</code>s</a> and their helpers (<code>partial()</code>, <code>field()</code> and <code>component()</code>).</p><p>Using the default <a href="./05-concepts.html#resolvers"><code>Resolver</code></a>, these helpers will map to resolving partial templates (we call them <a href="./05-concepts.html#patterns"><code>Patterns</code></a>) in <code>templates/_partials/</code>, <code>templates/_fields/</code> and <code>templates/_components/</code> respectively, but you can change that to suit your needs by just editing the key name to change the helper name, and the value to change the subdirectory within <code>templates/</code> .</p><h2 id="using-the-pattern-helper-functions" tabindex="-1">Using the Pattern helper functions <a class="header-anchor" href="#using-the-pattern-helper-functions" aria-hidden="true">#</a></h2><p><code>helperMethod($path, $context)</code></p><p>All template helper functions take two arguments:</p><ol><li><code>path</code>: A required string path that identifies the Pattern (<code>&#39;card/blog</code> in this case)</li><li><code>context</code> A Twig object representing the context to use when rendering the template <code>{ data: { entry: entry } }</code>. This may be optional, depending on the <a href="./03-managing-context.html">context rules</a> rules that you have set up for this Pattern Type</li></ol><div class="language-twig"><span class="copy"></span><pre><code><span class="line"><span style="color:#89DDFF;">{{ component(</span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">card/blog</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">, { </span><span style="color:#A6ACCD;">data</span><span style="color:#89DDFF;">: { </span><span style="color:#A6ACCD;">entry</span><span style="color:#89DDFF;">: </span><span style="color:#A6ACCD;">entry</span><span style="color:#89DDFF;"> } }) }}</span></span>
<span class="line"></span></code></pre></div><p>Any variables you wish to use when rendering the Pattern&#39;s template must be explicitly passed, with the exception of the <code>craft</code> global. By design it is not possible to pass additional parameters to the Pattern. Instead, add keys to the context object instead.</p><h2 id="the-fallback-template" tabindex="-1">The fallback template <a class="header-anchor" href="#the-fallback-template" aria-hidden="true">#</a></h2><p>By default, if Conventions can&#39;t resolve the paths you provided to a template, it will look for a special template at <code>templates/missing.twig</code> to render instead. This template will have access to a <code>pattern</code> variable that you can use for rendered debug information. For example you might add something like this:</p><div class="language-twig"><span class="copy"></span><pre><code><span class="line"><span style="color:#89DDFF;">{% </span><span style="color:#89DDFF;font-style:italic;">if</span><span style="color:#89DDFF;"> </span><span style="color:#A6ACCD;">devMode</span><span style="color:#89DDFF;"> %}</span></span>
<span class="line"><span style="color:#A6ACCD;">  Missing template for </span><span style="color:#89DDFF;">{{ </span><span style="color:#A6ACCD;">pattern</span><span style="color:#89DDFF;">.</span><span style="color:#A6ACCD;">type</span><span style="color:#89DDFF;">.</span><span style="color:#A6ACCD;">handle</span><span style="color:#89DDFF;"> }}</span><span style="color:#A6ACCD;"> with paths </span><span style="color:#89DDFF;">{{ </span><span style="color:#A6ACCD;">pattern</span><span style="color:#89DDFF;">.</span><span style="color:#A6ACCD;">paths</span><span style="color:#89DDFF;"> | </span><span style="color:#A6ACCD;">join</span><span style="color:#89DDFF;"> (</span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">,</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">) }}</span></span>
<span class="line"><span style="color:#89DDFF;">{% </span><span style="color:#89DDFF;font-style:italic;">endif</span><span style="color:#89DDFF;"> %}</span></span>
<span class="line"></span></code></pre></div><p>If no fallback template is found, Conventions won&#39;t render anything in the case of a missing template, but will log errors to <code>storage/logs/conventions.log</code>.</p><h3 id="changing-the-fallback-template-path" tabindex="-1">Changing the fallback template path <a class="header-anchor" href="#changing-the-fallback-template-path" aria-hidden="true">#</a></h3><p>You can change the fallback template path for all <code>PatternType</code>s via the <code>defaults.resolver.settings.fallbackTemplate</code> settings:</p><div class="language-php"><span class="copy"></span><pre><code><span class="line"><span style="color:#676E95;font-style:italic;">// config/conventions.php</span></span>
<span class="line"><span style="color:#89DDFF;font-style:italic;">return</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">...</span></span>
<span class="line"><span style="color:#A6ACCD;">      </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">defaults</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">          </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">resolver</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">settings</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">                 </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">fallbackTemplate</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_special/missing</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">              </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">          </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">      </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">  </span><span style="color:#89DDFF;">...</span><span style="color:#A6ACCD;"> </span></span>
<span class="line"><span style="color:#89DDFF;">];</span></span>
<span class="line"></span></code></pre></div><p>To use a custom fallback for a single PatternType, you can use the <a href="./02-advanced-config.html">advanced / expanded config syntax</a> to override the resolver settings:</p><div class="language-php"><span class="copy"></span><pre><code><span class="line"><span style="color:#676E95;font-style:italic;">// config/conventions.php</span></span>
<span class="line"><span style="color:#89DDFF;font-style:italic;">return</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">patterns</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">partial</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_partials</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">field</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_fields</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">component</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">resolver</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">                </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">basePath</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_components</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#89DDFF;">                </span><span style="color:#676E95;font-style:italic;">// override \`fallbackTemplate\` for just the component() helper / PatternType            </span></span>
<span class="line"><span style="color:#A6ACCD;">                </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">fallbackTemplate</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_missing/component</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">defaults</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">resolver</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">settings</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">[</span></span>
<span class="line"><span style="color:#A6ACCD;">                </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">fallbackTemplate</span><span style="color:#89DDFF;">&#39;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">=&gt;</span><span style="color:#A6ACCD;"> </span><span style="color:#89DDFF;">&#39;</span><span style="color:#C3E88D;">_missing/default</span><span style="color:#89DDFF;">&#39;</span><span style="color:#89DDFF;">,</span></span>
<span class="line"><span style="color:#A6ACCD;">            </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">        </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#A6ACCD;">    </span><span style="color:#89DDFF;">],</span></span>
<span class="line"><span style="color:#89DDFF;">];</span></span>
<span class="line"></span></code></pre></div>`,20),o=[e];function t(c,r,D,y,F,i){return n(),a("div",null,o)}var d=s(p,[["render",t]]);export{A as __pageData,d as default};