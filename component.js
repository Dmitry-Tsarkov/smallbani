#!/usr/bin/env node

const fs = require('fs');

class Component {
  constructor(args) {
    this.args = args;
    this.root = `${__dirname}/frontend`;
    this.path = `${__dirname}/frontend/components`;
    this.actions = ['add', 'remove', 'rename'];
    this.exts = ['scss', 'pug'];
    this.init();
  }
  async init() {
    try {
      const { name, newName, action, args } = await this.parseArgs();

      this.name = name;
      this.components = this.getComponents();
      this.exts = Array.from(new Set([...this.exts, ...args]));

      await this[action](name, newName);
    } catch (error) {
      console.error('-----------------------');
      console.error(error);
      console.error('-----------------------');
    }
  }
  parseArgs() {
    return new Promise((resolve, reject) => {
      const state = {
        action: this.args[2]
      };

      if (!state.action) {
        reject('Name or action required');
      }

      if (this.actions.includes(state.action)) {
        state.name = this.args[3];

        if (!state.name) {
          reject('Component name required');
        }

        if (state.action === 'rename') {
          state.newName = this.args[4];
          state.args = this.args.slice(5);
        } else {
          state.args = this.args.slice(4);
        }
      } else {
        state.name = state.action;
        state.action = 'add';
        state.args = this.args.slice(3);
      }

      return resolve(state);
    });
  }
  getComponents() {
    try {
      return require(`${this.path}/components.json`);
    } catch (error) {
      return [];
    }
  }
  async add(name) {
    try {
      if (!this.componentExist(this.name, this.components)) {
        this.components.push(name);
        await this.createFolder(this.name);
        await this.updateJSONFile(this.components);
        await this.injectCSS(this.components);

        console.log('-----------------------');
        console.log(`Component «${name}» added`);
        console.log(`extentions: ${this.exts.join(', ')}`);
        console.log('-----------------------');
      } else {
        throw new Error('Component already added');
      }
    } catch (error) {
      throw new Error(error);
    }
  }
  async remove(name) {
    try {
      if (this.componentExist(name, this.components)) {
        this.components = this.components.filter(c => c !== name);

        await this.removeFolder(name);
        await this.updateJSONFile(this.components);
        await this.injectCSS(this.components);

        console.log('-----------------------');
        console.log(`Component «${name}» removed`);
        console.log('-----------------------');
      } else {
        throw new Error('Component not found');
      }
    } catch (error) {
      throw new Error(error);
    }
  }
  async rename(name, newName) {
    try {
      if (this.componentExist(name, this.components)) {
        this.components = this.components.map(component => {
          return component === name ? newName : component;
        });

        await this.renameFolder(name, newName);
        await this.updateJSONFile(this.components);
        await this.injectCSS(this.components);

        console.log('-----------------------');
        console.log(`Component «${name}» renamed`);
        console.log(`New name «${newName}»`);
        console.log('-----------------------');
      } else {
        throw new Error('Component not found');
      }
    } catch (error) {
      throw new Error(error);
    }
  }
  componentExist(name, components) {
    return Boolean(components.find(c => c === name));
  }
  createFolder(name) {
    return new Promise((resolve, reject) => {
      const path = `${this.path}/${name}`;

      fs.mkdir(path, { recursive: true }, error => {
        if (error) {
          reject(error);
        }

        Promise.all(this.exts.map(ext => this.addFile(ext, path, name)))
          .then(resolve)
          .catch(reject);
      });
    });
  }
  removeFolder(name) {
    return new Promise((resolve, reject) => {
      const path = `${this.path}/${name}`;

      try {
        fs.readdirSync(path).forEach(entry => {
          fs.unlinkSync(`${path}/${entry}`);
        });

        fs.rmdirSync(path);

        resolve();
      } catch (error) {
        reject(error);
      }
    });
  }
  renameFolder(name, newName) {
    return new Promise((resolve, reject) => {
      const path = `${this.path}/${name}`;
      const newPath = `${this.path}/${newName}`;

      try {
        fs.readdirSync(path).forEach(entry => {
          const [name, ext] = entry.split('.');
          fs.renameSync(`${path}/${entry}`, `${path}/${newName}.${ext}`);
        });

        fs.renameSync(path, newPath);

        resolve();
      } catch (error) {
        reject(error);
      }
    });
  }
  addFile(ext, folderPath, name) {
    return new Promise((resolve, reject) => {
      const path = `${folderPath}/${name}.${ext}`;
      const content = this.getContent(ext, name);

      try {
        fs.writeFile(path, content, error => {
          if (error) reject(error);
          resolve();
        });
      } catch (error) {
        reject(error);
      }
    });
  }
  updateJSONFile(components) {
    return new Promise((resolve, reject) => {
      try {
        const content = JSON.stringify(components.sort(), '', 2);
        const path = `${this.path}/components.json`;

        fs.writeFile(path, content, error => {
          if (error) throw reject(error);
          resolve();
        });
      } catch (error) {
        reject(error);
      }
    });
  }
  injectCSS(components) {
    return new Promise((resolve, reject) => {
      const handler = name => `@import '../components/${name}/${name}';\n`;
      const path = `${this.root}/styles/_components.scss`;

      try {
        fs.writeFile(
          path,
          components
            .sort()
            .map(handler)
            .join(''),
          error => {
            if (error) throw reject(error);
            resolve();
          }
        );
      } catch (error) {
        reject(error);
      }
    });
  }
  getContent(ext, name) {
    const map = {
      scss: `/**\n* ${name}\n*/\n\n.${name} {\n  $this: &;\n\n\n}\n`,
      pug: `//- ${name}\n\nmixin ${name}(options = {})\n  .${name}`,
      js: `/**\n* ${name}\n*/\n`
    };

    return map[ext];
  }
}

new Component(process.argv);
