export default {
  title: 'Craft Conventions',
  description: 'Better #craftcms sites through strong conventions',
  themeConfig: {
    logo: '/zaengle.svg',
    nav: [
      { text: 'Guide', link: '/' },
      { text: 'GitHub', link: 'https://github.com/zaengle/craft-conventions' },
      { text: 'Open an issue', link: 'https://github.com/zaengle/craft-conventions/issues' },
    ],
    sidebar: [
      {
        text: 'Getting Started',
        items: [
          { text: 'Home', link: '/' },
          { text: 'Installation', link: '/00-installation' },
          { text: 'Getting started', link: '/01-basic-usage' },
        ]
      },{
        text: 'Advanced Usage',
        items: [
          { text: 'Expanded Config Syntax', link: '/02-advanced-config' },
          { text: 'Managing Context', link: '/03-managing-context' },
          { text: 'Custom Resolvers', link: '/04-custom-resolvers' },
          { text: 'Plugin Internals / Concepts', link: '/05-concepts' },
        ]
      },
      {
        text: 'Made with ❤️ by Zaengle',
        items: [
          { text: 'Be Nice, Do Good', link: 'https://zaengle.com/'},
        ]
      }
    ]
  }
};
